<?php

namespace App\Http\Controllers\Admin\SMS;


use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Newsletter;
use App\Models\SmsCampaign;
use App\Models\SmsLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SmsSendController extends Controller
{
    public function sendSMS($id)
    {
        $requestContent = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ];
        $apikey='';
        $apisecrat='';


        date_default_timezone_set('Asia/Dhaka');
        $smstemplete=SmsCampaign::where('id',$id)->first();
        $message=$smstemplete->content;

        if ($smstemplete->type=='Client'){
            $smsdatas = Customer::get();
        }else{
            $smsdatas = Newsletter::where('status', 'Active')->get();
        }
        //dd($smsdatas);
        foreach ($smsdatas as $smsdata){

            if ($smsdata->phone !=NULL){
                $phone = $smsdata->phone;
                $url = 'http://217.172.190.215/sendtext/sendtext?apikey=' . $apikey . '&secretkey=' . $apisecrat . '&callerID=1234&toUser=' . $phone . '&messageContent=' . $message . '';
                $client = new Client();
                $request = $client->request('GET', $url, $requestContent);
                $response = json_decode($request->getBody());
                //dd($response->Status);
                $slog['message_id'] = $response->Message_ID;
                $slog['subject'] = $smstemplete->subject;
                $slog['content'] = $message;
                $slog['phone'] = $phone;
                $slog['delivary']=$response->Text;
                $slog['status'] = $response->Status;
                //dd($slog);
                SmsLog::create($slog);
            }
        }

        $smscamp['send_status']='Send';
        $smstemplete->update($smscamp);

        Session::flash('status','Your SMS Campaign has been sucessfully send!!');
        return redirect('/madmin/smscampaign');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
