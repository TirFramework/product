<?php

namespace Tir\Store\Payment\Gateways;

use Tir\Setting\Facades\Stg;
use Tir\Store\Checkout\Events\OrderPlaced;
use Tir\Store\Order\Entities\Order;
use Tir\Store\Payment\Libs\RSA;
use Tir\Store\Payment\Libs\RSAProcessor;
use Tir\Store\Payment\NullResponse;
use Tir\Store\Transaction\Entities\Transaction;


class PasargadGeteway
{
    public $label;
    public $description;

    private $privateKey;
    private $merchantCode;
    private $terminalCode;
    private $timeStamp;
    private $order;

    public function __construct()
    {
        $this->label = Stg::get('pasargad_gateway_label');
        $this->description = Stg::get('pasargad_gateway_description');
        $this->privateKey = Stg::get('pasargad_gateway_private_key');
        $this->merchantCode = Stg::get('pasargad_gateway_merchant_code');
        $this->terminalCode = Stg::get('pasargad_gateway_terminal_key');

    }

    public function purchase($order)
    {
        $this->order = $order;
        $this->timeStamp = date("Y/m/d H:i:s");
        return $this;
    }


    public function isView()
    {
        return true;
    }


    public function getView()
    {
        $arraySign = [
            $this->merchantCode,
            $this->terminalCode,
            $this->order->id,
            $this->order->created_at->format("Y/m/d H:i:s"),
            $this->order->total->amount() * 10,
            config('app.url') . "/checkout/payment-callback/pasargad_gateway",
            "1003",
            $this->timeStamp
        ];

        $transaction = [
            'order_id'       => $this->order->id,
            'payment_method' => 'pasargad_gateway',
            'status'         => 'created'
        ];

        Transaction::create($transaction);

        return view('gateway::pasargad-redirector')
            ->with([
                    'url'           => "https://pep.shaparak.ir/gateway.aspx",
                    'redirectUrl'   => config('app.url') . "/checkout/payment-callback/pasargad_gateway",
                    'invoiceNumber' => $this->order->id,
                    'invoiceDate'   => $this->order->created_at->format("Y/m/d H:i:s"),
                    'amount'        => $this->order->total->amount() * 10,
                    'terminalCode'  => $this->terminalCode,
                    'merchantCode'  => $this->merchantCode,
                    'timeStamp'     => $this->timeStamp,
                    'action'        => "1003",
                    'sign'          => $this->makeSign($arraySign)
                ]
            );
    }


    public function isRedirect()
    {
        return false;
    }

    private function makeSign(array $array)
    {
        $processor = new RSAProcessor($this->privateKey);
        $data = '#';
        foreach ($array as $d) {
            $data .= $d . '#';
        }
        $data = sha1($data, true);
        $data = $processor->sign($data);
        return base64_encode($data); // base64_encode
    }

    public function check($requests)
    {
        $orderId = $requests['iN'];
        $order = Order::findOrfail($orderId);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://pep.shaparak.ir/CheckTransactionResult.aspx', [
            'form_params' => [
                'invoiceUID' => $requests['tref']
            ]
        ]);

        $xmlResponse = simplexml_load_string($response->getBody());

        //update transaction
        Transaction::where('order_id', $orderId)->update([
            'transaction_id' => $xmlResponse->transactionReferenceID,
            'status' => $xmlResponse->action,
        ]);

        if ($xmlResponse->result != 'True') {
            return view(config('crud.front-template') . '::public.checkout.cancel.show', compact('order'));
        } else {
            return $this->confirm($orderId);
        }

    }

    public function confirm($orderId)
    {
        $this->order = Order::findOrFail($orderId);
        $this->timeStamp = date("Y/m/d H:i:s");
        $arraySign = [
            $this->merchantCode,
            $this->terminalCode,
            $this->order->id,
            $this->order->created_at->format("Y/m/d H:i:s"),
            $this->order->total->amount() * 10,
            $this->timeStamp
        ];

        $formData = [
            'MerchantCode'  => $this->merchantCode,
            'TerminalCode'  => $this->terminalCode,
            'InvoiceNumber' => $this->order->id,
            'InvoiceDate'   => $this->order->created_at->format("Y/m/d H:i:s"),
            'amount'        => $this->order->total->amount() * 10,
            'TimeStamp'     => $this->timeStamp,
            'sign'          => $this->makeSign($arraySign)
        ];

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://pep.shaparak.ir/VerifyPayment.aspx', [
            'form_params' => $formData
        ]);
        $xmlResponse = simplexml_load_string($response->getBody());


        $order = $this->order;
        if ($xmlResponse->result != 'True') {
            Transaction::where('order_id', $orderId)->update([
                'status' => $xmlResponse->result,
                'details'  => $xmlResponse->resultMessage
            ]);

                return view(config('crud.front-template') . '::public.checkout.cancel.show', compact('order'));
        } else {
            Transaction::where('order_id', $orderId)->update([
                'status' => 'paid',
                'paid_at' => $this->timeStamp,
                'details'  => $xmlResponse->resultMessage
            ]);
            return $this->storeOrder($this->order);
        }


    }


    private function storeOrder($order)
    {

        event(new OrderPlaced($order));

        session()->put('placed_order', $order);

        return redirect()->route('checkout.complete.show');

    }


}
