<?php

namespace Tir\Store\Payment\Gateways;

use Tir\Setting\Facades\Stg;
use Tir\Store\Payment\Libs\RSA;
use Tir\Store\Payment\Libs\RSAProcessor;
use Tir\Store\Payment\NullResponse;


class IRBank
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = Stg::get('IRBank_label');
        $this->description = Stg::get('IRBank_description');

        $this->label = 'test';
        $this->description = 'test';
    }

    public function purchase()
    {
        $publicKey =
'
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDI7L3DmiAd/+dfTLIbOuevCJLw
F05x+RAgBVqMbaIQqB0ZnU/C/Uqr91QH2oglwuTQMyaM6P5u69hf4QcjOa7icQLZ
20oIy3AeQgU+5oi0vjyRaCHPnZnMVFwd+YJHOeE7JLyEThTVo3UkNVhDJl/DSGaK
jm/OBeO4HpGkWDSgGQIDAQAB
-----END PUBLIC KEY-----
';

        $privateKey =
'
-----BEGIN RSA PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAMjsvcOaIB3/519M
shs6568IkvAXTnH5ECAFWoxtohCoHRmdT8L9Sqv3VAfaiCXC5NAzJozo/m7r2F/h
ByM5ruJxAtnbSgjLcB5CBT7miLS+PJFoIc+dmcxUXB35gkc54TskvIROFNWjdSQ1
WEMmX8NIZoqOb84F47gekaRYNKAZAgMBAAECgYBXC3kKjHLtjDfIaYmfkl1czvIZ
YX9ykNwTgz4/KB/V537z4dr0Npdq+LNG07233j8Sk5ZX5XiUxUfwAaT99bd1TGEL
4OwG9VQQspSFasNW1CJ6R5w6U5y07DQ3+xDy7NHJ3yZyMLap3xtB25VCLd+nC3NL
GphCz8c4POHURMccgQJBAP/PacO+v34MZXpOWANQkiNbItmGQ4nnMWFFK5TKGR0B
+q+Xy3RpuF/mcDzuw77GdMwVQtkC9FFQmFcPWzWX3a0CQQDJEudPYDlZQ6PyJ1t2
AMt5HE6C3QbG0Afct9Z8ApE+XxVQR9a4jTpahYiOh2GDbPj648uWO8BQb4/7NauJ
hAGdAkAAxdml87+UW+k6k14EtIuce7wBODygAAjQKGtXSb0Fr2nYefbtZRxffcy9
AmOpAeR8cVwAV9fxHvM24B8AbHMJAkB5bEjyzhDTrt0aJlo88E3vXQCsVfz5ojad
Owby7Dn5iEG+sSMhX2eVsn28VFS2oN/Z4iXXG04PRM+Vy9tCt8yhAkEA/eY8yrTH
gmjWumhuHwbpjOnKra9YAKPaUKvCn5JbinTGzs/3xGor7+mgg9L8DKfr2LFIcZru
e+ci5Cz5XR6gew==
-----END RSA PRIVATE KEY-----
';

        $rsa = new RSA($publicKey, $privateKey);
       // $encrypted = $rsa->encrypt($data);
        //$decrypted = $rsa->decrypt($encrypted);



        $client = new \GuzzleHttp\Client();
       // $rsaPrivateKey = '<RSAKeyValue><Modulus>yOy9w5ogHf/nX0yyGzrnrwiS8BdOcfkQIAVajG2iEKgdGZ1Pwv1Kq/dUB9qIJcLk0DMmjOj+buvYX+EHIzmu4nEC2dtKCMtwHkIFPuaItL48kWghz52ZzFRcHfmCRznhOyS8hE4U1aN1JDVYQyZfw0hmio5vzgXjuB6RpFg0oBk=</Modulus><Exponent>AQAB</Exponent><P>/89pw76/fgxlek5YA1CSI1si2YZDiecxYUUrlMoZHQH6r5fLdGm4X+ZwPO7DvsZ0zBVC2QL0UVCYVw9bNZfdrQ==</P><Q>yRLnT2A5WUOj8idbdgDLeRxOgt0GxtAH3LfWfAKRPl8VUEfWuI06WoWIjodhg2z4+uPLljvAUG+P+zWriYQBnQ==</Q><DP>AMXZpfO/lFvpOpNeBLSLnHu8ATg8oAAI0ChrV0m9Ba9p2Hn27WUcX33MvQJjqQHkfHFcAFfX8R7zNuAfAGxzCQ==</DP><DQ>eWxI8s4Q067dGiZaPPBN710ArFX8+aI2nTsG8uw5+YhBvrEjIV9nlbJ9vFRUtqDf2eIl1xtOD0TPlcvbQrfMoQ==</DQ><InverseQ>/eY8yrTHgmjWumhuHwbpjOnKra9YAKPaUKvCn5JbinTGzs/3xGor7+mgg9L8DKfr2LFIcZrue+ci5Cz5XR6gew==</InverseQ><D>Vwt5Coxy7Yw3yGmJn5JdXM7yGWF/cpDcE4M+Pygf1ed+8+Ha9DaXavizRtO9t94/EpOWV+V4lMVH8AGk/fW3dUxhC+DsBvVUELKUhWrDVtQiekecOlOctOw0N/sQ8uzRyd8mcjC2qd8bQduVQi3fpwtzSxqYQs/HODzh1ETHHIE=</D></RSAKeyValue>';
       // $processor = new RSAProcessor($rsaPrivateKey);

        $url = "https://pep.shaparak.ir/Api/v1/Payment/GetToken";

        $data['Content-Type'] = "Application/json";
        $data['InvoiceNumber'] = "1";
        $data['InvoiceDate'] = "1399";
        $data['TerminalCode'] = "1985616";
        $data['MerchantCode'] = "4793697";
        $data['Amount'] = 50000.00;
        $data['RedirectAddress'] = "http://nictahvieh.loc";
        $data['Timestamp'] = date("Y/m/d H:i:s");;
        $data['Action'] = "1003";
//        $data['SubPaymentList'] = "";

        $jData = json_encode($data);
        dd($jData);
        $body['sign'] =  $rsa->encrypt($jData);

        $body['data'] = $jData;

        $response = $client->request('post', $url,  ['form_params'=>$body]);

        echo ($response->getBody());

        dd();

    }
}
