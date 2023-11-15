<?php

namespace Anburocky3\PhonepeLaravel;

use Illuminate\Http\RedirectResponse;

class PhonePe
{
    public string $env;
    public string $mobileNo;
    public string $redirectUrl;
    private string $baseUrl;
    private mixed $saltKey;
    private mixed $saltIndex;

    /**
     * @param $mobileNo
     * @param $redirectUrl
     */
    public function __construct($mobileNo, $redirectUrl)
    {
        $this->env = config('phonepe.env');
        $this->mobileNo = $mobileNo;
        $this->redirectUrl = $redirectUrl;
        $this->baseUrl = config('phonepe.env') == 'production' ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        $this->saltKey = config('phonepe.saltKey');
        $this->saltIndex = config('phonepe.saltIndex');
    }

    public function makePayment($merchantUserId, $amount = 1): RedirectResponse
    {

        // dd($amount);

        $data = array(
            'merchantId' => config('phonepe.merchantId'),
            'merchantTransactionId' => $this->generateMerchantTransactionId(),
            'merchantUserId' => $merchantUserId,
            'amount' => $amount * 100,
            'redirectUrl' => $this->redirectUrl,
            'redirectMode' => 'POST',
            'callbackUrl' => $this->redirectUrl,
            'mobileNumber' => '9999999999',
            'paymentInstrument' =>
                array(
                    'type' => 'PAY_PAGE',
                ),
        );


        $encode = base64_encode(json_encode($data));

        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;

        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);

        $finalXHeader = $sha256 . '###' . $saltIndex;

        // $response = Curl::to('https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay')
        //         ->withHeader('Content-Type:application/json')
        //         ->withHeader('X-VERIFY:'.$finalXHeader)
        //         ->withData(json_encode(['request' => $encode]))
        //         ->post();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-VERIFY: ' . $finalXHeader
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);

        return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);

    }

    public function getTransactionStatus(array $request): bool
    {

        $finalXHeader = hash('sha256','/pg/v1/status/'.$request['merchantId'].'/'.$request['transactionId'].$this->saltKey).'###'.$this->saltIndex;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseUrl.'/pg/v1/status/'.$request['merchantId'].'/'.$request['transactionId'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'accept: application/json',
                'X-VERIFY: '.$finalXHeader,
                'X-MERCHANT-ID: '.$request['transactionId']
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if (json_decode($response)->success) {
            return true;
        }
        else
        {
            return false;
        }
    }

    private function generateMerchantTransactionId(): string
    {
        return uniqid();
    }

}
