<?php

namespace Concave\Bkash\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller{
    
    public function token(){
        session_start();
        $request_token = $this->_bkash_Get_Token();
        $idtoken = $request_token['id_token'];
        $_SESSION['token'] = $idtoken;
        $array = $this->_get_config_file();
        $array['token'] = $idtoken;
        $newJsonString = json_encode($array);
        File::put(public_path('concave/config.json'), $newJsonString);
        echo $idtoken;
    }

    protected function _bkash_Get_Token(){
        $array = $this->_get_config_file();
        $post_token = array(
            'app_key' => $array["app_key"],
            'app_secret' => $array["app_secret"]
        );

        $url = curl_init($array["tokenURL"]);
        $proxy = $array["proxy"];
        $posttoken = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'password:' . $array["password"],
            'username:' . $array["username"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    protected function _get_config_file(){
        $path = public_path('concave/config.json');
        return json_decode(file_get_contents($path), true);
    }

    public function createpayment(){
        session_start();
        $array = $this->_get_config_file();
        $amount = $_GET['amount'];
        $invoice = $_GET['invoice']; // must be unique
        $intent = $_GET['intent'];
        $proxy = $array["proxy"];
        $createpaybody = array('amount' => $amount, 'currency' => 'BDT', 'merchantInvoiceNumber' => $invoice, 'intent' => $intent);
        $url = curl_init($array["createURL"]);

        $createpaybodyx = json_encode($createpaybody);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $array["token"],
            'x-app-key:' . $array["app_key"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $createpaybodyx);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);

        $resultdata = curl_exec($url);
        curl_close($url);
        echo $resultdata;
    }

    public function executepayment(){
        session_start();
        $array = $this->_get_config_file();
        $paymentID = $_GET['paymentID'];
        $proxy = $array["proxy"];
        $url = curl_init($array["executeURL"] . $paymentID);
        $header = array(
            'Content-Type:application/json',
            'authorization:' . $array["token"],
            'x-app-key:' . $array["app_key"]
        );
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdatax = curl_exec($url);
        curl_close($url);
        $this->_updateOrderStatus($resultdatax);
        echo $resultdatax;
    }

    protected function _updateOrderStatus($resultdatax){
        $resultdatax = json_decode($resultdatax);
        if(isset($resultdatax->paymentID)){
            if ($resultdatax && $resultdatax->paymentID != null) {
                $data['amount'] =  $resultdatax->amount;
                $data['currency'] =  $resultdatax->currency;
                $data['invoice_number'] =  $resultdatax->merchantInvoiceNumber;
                $data['intent'] =  $resultdatax->intent;
                $data['payment_id'] =  $resultdatax->paymentID;
                $data['trxID'] =  $resultdatax->trxID;
                $data['status'] =  $resultdatax->transactionStatus;
                $timestamp = substr($resultdatax->updateTime,0,19);   
                $dateTime = date_format(date_create($timestamp),'Y-m-d H:i:s');
                $mysqlFormatedDateTime =  date('Y-m-d H:i:s', strtotime($dateTime)+21600); //DateTime response was in GMT+0000 that's why we add 6 hours 
                $data['created_at'] = $mysqlFormatedDateTime;
                $data['updated_at'] = $mysqlFormatedDateTime;
                DB::table('concave_bkash_response')->insert($data);
            }
        }

    }
}