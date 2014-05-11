<?php


//Moolah API Wrapper

//Requirements: cURL

 
class MoolahTransaction
{     
    private $mAmount;
    private $mApiKey;
    private $mCallbackUrl;
    private $mCoin;
    private $mProductName;
    

    public $address;
    public $amount;
    public $currency;
    public $tx;
    public $url;

    public function __construct($amount, $apiKey, $callbackUrl, $coin, $productName) {
        $this->mAmount      = $amount;
        $this->mApiKey      = $apiKey;
        $this->mCallbackUrl = $callbackUrl;
        $this->mCoin        = $coin;
        $this->mProductName = $productName;
    }

    private function _request($url) {
    	$curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response ? json_decode($response) : false;
    }

    public function create_tx() {
        $curlUrl = "https://moolah.io/api/pay?guid=" . $this->mApiKey;
        $curlUrl .= "&currency=" . $this->mCoin;
        $curlUrl .= "&amount=" . $this->mAmount;
        $curlUrl .= "&product=" . $this->mProductName;
        $curlUrl .= "&return=" . $this->mCallbackUrl;
        return $this->_request($curlUrl);
    }

    public function check_tx($tx) {
        $curlUrl = "https://moolah.io/api/pay/check/" . $tx;
        return $this->_request($curlUrl);
    }
}
