<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class ComplainBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complains=Complain::orderBy('id','DESC')->paginate(10);
        return view('Admin.Complainbox.index', compact('complains'));
    }

    //Pending
    public function pending()
    {
        $complains=Complain::where('status','Pending')->orderBy('id','DESC')->paginate(10);
        return view('Admin.Complainbox.pending', compact('complains'));
    }
    //Complete
    public function complete()
    {
        $complains=Complain::where('status','Complete')->orderBy('id','DESC')->paginate(10);
        return view('Admin.Complainbox.complete', compact('complains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Complainbox.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$compalain=Complain::findOrFail($id);
        $data = $request->all();
        if($file=$request->file('attachment')){
            $img=preg_replace('/\s+/', '-','.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/complain/');
            $img = Image::make($file->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $category['attachment']=$names;
        }
        $category['name'] = $data['name'];
        $category['phone'] = $data['phone'];
        $category['email'] = $data['email'];
        $category['subject'] = $data['subject'];
        $category['complain'] = $data['complain'];
        $category['status'] = $data['status'];
        Complain::create($category);
        Session::flash('status','Your Complain has been sucessfully add');
        return redirect()->route('madmin.complainadmin.index');
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
        $edits=Complain::findOrFail($id);
        return view('Admin.Complainbox.edit', compact('edits'));
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
        $compalain=Complain::findOrFail($id);
        $data = $request->all();
        if($file=$request->file('attachment')){
            $img=preg_replace('/\s+/', '-','.'. $file->extension());
            $names=time().$img;
            //$names=$img;
            $destinationPath = public_path('images/complain/');
            $img = Image::make($file->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $names);
            $category['attachment']=$names;
        }
        $category['name'] = $data['name'];
        $category['phone'] = $data['phone'];
        $category['email'] = $data['email'];
        $category['subject'] = $data['subject'];
        $category['complain'] = $data['complain'];
        $category['status'] = $data['status'];
        $compalain->update($category);
        Session::flash('status','Your Complain has been sucessfully add');
        return redirect()->route('madmin.complainadmin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compalain=Complain::findOrFail($id);
        $compalain->delete();
        Session::flash('status','Your Complain has been sucessfully add');
        return redirect()->route('madmin.complainadmin.index');
    }
}
