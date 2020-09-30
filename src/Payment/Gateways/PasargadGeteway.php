<?php

namespace Tir\Store\Payment\Gateways;

use Tir\Setting\Facades\Stg;
use Tir\Store\Payment\Libs\RSA;
use Tir\Store\Payment\Libs\RSAProcessor;
use Tir\Store\Payment\NullResponse;


class PasargadGeteway
{
    public $label;
    public $description;

    private $url;
    private $privateKey;
    private $merchantCode;
    private $terminalCode;
    private $amount;
    private $redirectUrl;
    private $invoiceNumber;
    private $timeStamp;
    private $invoiceDate;
    private $action;
    private $sign;

    public function __construct()
    {
        // $this->label = Stg::get('IRBank_label');
        // $this->description = Stg::get('IRBank_description');
        $this->label = 'test';
        $this->description = 'test';

        $this->privateKey = '<RSAKeyValue><Modulus>x/QTWTEmvdrnyvNVe1kN5WfJP6Wet2HFRjxSs6IXkV4Uh9vkHmKWxq32i/Agr+dytxoJYVyguavgjnpEpeBD2fhXgC9jvUvvjBbRRWYt52du5Z7tfnR3YLb/jk5Tsb+6FHO0mNyYo5GgPlB91iOOKYltvEWO+9JXjoLQXCUZMUE=</Modulus><Exponent>AQAB</Exponent><P>1R73UDeNGTvuEG4AGttrIQmbstznPHqw6pPQ267IKegfHfHH6aXiFTjc/1zcGx4yn59/WaXmdpxlsKicLItYew==</P><Q>8C7miwMukAtcjDIO/SjoT6eBuo70j8NM3ubDLLZlD3QyvYHJdi8103tiVZ2e46kvJz0mACoo9nOYX8TJo/u2cw==</Q><DP>K1XGmAsTp8Pl3nVflBZ1rBwWCsKcSlHwU2KHH4RksxC98wrMyZevZv1PAqXRI7p6NLbr4EC5ofifPNKsHuqerQ==</DP><DQ>gM4GIQLB08nkBeNKmoV3oFAKiEvl57sq3FcQ0Ee4hsMf+vVBXzoOOa3vnE59SUYP3ZEzcd8qPJDdZG6aXHC+9Q==</DQ><InverseQ>GFOCHtQctaFucAUBmVODKr27/AiaRhA41ff9Ors46bG5KPDN94FXes2tuDbtM+qujlTBHH2RNUckJqv+QCAEww==</InverseQ><D>ce76o2TlXWMBltwGhk1dJK15t+GISZfVT8sJmL+wzC0eZ7d9CW9F2JnBlUVTasfnzrtwQuED2Cg+wRCcUyQxpFyYjb2EzCDB3OViaz4oZN5Aj3TeGC/g2yTaE72LRkpF3J7i1wBZcBfluRnZZDLVbXfJMpVL6elf2MfE6fWQey0=</D></RSAKeyValue>';
        $this->merchantCode = '4793697';
        $this->terminalCode = '1985616';
        $this->redirectUrl = config('app.url')."/checkout/payment-callback/pasargad_gateway";
        $this->action = "1003";    //for shop request must be 1003
        $this->url = "https://pep.shaparak.ir/gateway.aspx";



    }

    public function purchase($order)
    {
        $this->amount = $order->total->amount() * 10; //exchange to rial
        $this->invoiceNumber = $order->id;
        $this->invoiceDate = $order->created_at;
        $this->timeStamp = date("Y/m/d H:i:s");
        $this->sign = $this->makeSign();
        return $this;
    }


    public function isView()
    {
        return true;
    }


    public function getView()
    {
        return view('gateway::pasargad-redirector')
            ->with([
                    'url'           => $this->url,
                    'redirectUrl'   => $this->redirectUrl,
                    'invoiceNumber' => $this->invoiceNumber,
                    'invoiceDate'   => $this->invoiceDate,
                    'amount'        => $this->amount,
                    'terminalCode'  => $this->terminalCode,
                    'merchantCode'  => $this->merchantCode,
                    'timeStamp'     => $this->timeStamp,
                    'action'        => $this->action,
                    'sign'          => $this->sign
                ]
            );
    }


    public function isRedirect()
    {
        return false;
    }

    private function makeSign()
    {
        $processor = new RSAProcessor($this->privateKey);
        $data = "#" . $this->merchantCode . "#" . $this->terminalCode . "#" . $this->invoiceNumber . "#" . $this->invoiceDate . "#" . $this->amount . "#" . $this->redirectUrl . "#" . $this->action . "#" . $this->timeStamp . "#";
        $data = sha1($data, true);
        $data = $processor->sign($data);
        return base64_encode($data); // base64_encode
    }

    public function check($requests)
    {
        dd($requests);
    }


}
