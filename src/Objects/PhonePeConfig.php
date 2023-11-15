<?php

namespace Anburocky3\PhonepeLaravel\Objects;

// class PhonePeConfig
// {
//     private $merchantId;
//     private $merchantTransactionId;
//     private $merchantUserId;
//     private $amount;
//     private $redirectUrl;
//     private $redirectMode;
//     private $callbackUrl;
//     private $mobileNumber;
//     private $paymentInstrument;
//
//     /**
//      * @param $merchantId
//      * @param $merchantTransactionId
//      * @param $merchantUserId
//      * @param $amount
//      * @param $redirectUrl
//      * @param $redirectMode
//      * @param $callbackUrl
//      * @param $mobileNumber
//      * @param $paymentInstrument
//      */
//     public function __construct($merchantId, $merchantTransactionId, $merchantUserId, $amount, $redirectUrl, $redirectMode, $callbackUrl, $mobileNumber, $paymentInstrument)
//     {
//         $this->merchantId = $merchantId;
//         $this->merchantTransactionId = $merchantTransactionId;
//         $this->merchantUserId = $merchantUserId;
//         $this->amount = $amount;
//         $this->redirectUrl = $redirectUrl;
//         $this->redirectMode = $redirectMode;
//         $this->callbackUrl = $callbackUrl;
//         $this->mobileNumber = $mobileNumber;
//         $this->paymentInstrument = $paymentInstrument;
//     }
//
//
// }

class PhonePeConfig
{
    private $merchantId;
    private $merchantTransactionId;
    private $merchantUserId;
    private $amount;
    private $redirectUrl;
    private $redirectMode;
    private $callbackUrl;
    private $mobileNumber;
    private $paymentInstrument;

    /**
     * @param $merchantId
     * @param $merchantTransactionId
     * @param $merchantUserId
     * @param $amount
     * @param $redirectUrl
     * @param $redirectMode
     * @param $callbackUrl
     * @param $mobileNumber
     * @param $paymentInstrument
     */
    public function __construct($configs = array())
    {
        foreach ($configs as $key => $value){
            $this->$key = $value;
        }
        // $this->merchantId = $merchantId;
        // $this->merchantTransactionId = $merchantTransactionId;
        // $this->merchantUserId = $merchantUserId;
        // $this->amount = $amount;
        // $this->redirectUrl = $redirectUrl;
        // $this->redirectMode = $redirectMode;
        // $this->callbackUrl = $callbackUrl;
        // $this->mobileNumber = $mobileNumber;
        // $this->paymentInstrument = $paymentInstrument;
    }


}
