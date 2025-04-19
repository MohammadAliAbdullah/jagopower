<?php

namespace App\Http\Controllers\Admin\SMS;

use App\DataCategory;
use App\Http\Controllers\Controller;
use App\Models\SmsCampaign;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SMSCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $timestamp = time();
//        $date_time = date("Y-m-d H:i:s", $timestamp);
//        echo "Current date and local time on this server is $date_time";
        //SMS Password: J@goPower
        //SMS id:jagopower
        $requestContent = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ];
        $url = 'https://smpp.ajuratech.com/portal/sms/smsConfiguration/smsClientBalance.jsp?client=jagopower';
        $client = new Client();
        $request = $client->request('GET', $url, $requestContent);
        $response = json_decode($request->getBody());
        $blance=$response->Balance;
        $values=SmsCampaign::orderBy('id','DESC')->paginate();
        return view('Admin.Marketing.smscampaign.index', compact('values','blance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Marketing.smscampaign.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        //dd(date("Y-m-d", strtotime($data['schedule'])));
        $udata['type']='Client';
        $udata['subject']=$data['subject'];
        $udata['content']=$data['content'];
        //$udata['schedule']=date("Y-m-d", strtotime($data['schedule']));
        //$udata['schedule_time']=date("H:i:s", strtotime($data['schedule']));
        $udata['status']=$data['status'];
        SmsCampaign::create($udata);
        Session::flash('status','SMS Campaign has been sucessfully add');
        return redirect('/madmin/smscampaign');
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
        $value=SmsCampaign::findOrFail($id);
        return view('Admin.Marketing.smscampaign.edit', compact('value'));
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
        $data=$request->all();
        $smscam=SmsCampaign::findOrFail($id);
        //$udata['dbcategory_id']=$data['datacat_id'];
        $udata['subject']=$data['subject'];
        $udata['content']=$data['content'];
//        $udata['schedule']=date("Y-m-d", strtotime($data['schedule']));
//        $udata['schedule_time']=date("H:i:s", strtotime($data['schedule']));
        $udata['status']=$data['status'];
        $smscam->update($udata);
        Session::flash('status','SMS Campaign has been sucessfully update');
        return redirect('/madmin/smscampaign');
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
