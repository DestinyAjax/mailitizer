<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SystemSetting;
use App\User;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_id'] = 6;
        $data['settings'] = SystemSetting::first();
        return view('admin.settings.index')->with($data);
    }

    public function profileIndex()
    {
        $data['menu_id'] = 5;
        $data['user'] = User::find(auth()->user()->id);
        return view('admin.profile.index')->with($data);
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
    public function update(Request $request)
    {
        $data = $request->all();
        try {
            $update = SystemSetting::find(1);
            $update->company_name = $data['company_name'];
            $update->website_url = $data['website'];
            $update->sender_name = $data['sender_name'];
            $update->sender_email = $data['sender_email'];
            $update->login_notification = $data['login'];
            $update->bcc_enabled = $data['bcc'];
            $update->subscribers_limit = $data['limit'];
            $update->host = $data['host'];
            $update->port = $data['port'];
            $update->encryption = $data['encryption'];
            $update->signature = $data['signature'] ? $data['signature'] : null;
            $update->service_provider = $data['provider'] ? $data['provider'] : null;
            $update->api_key = $data['api'] ? $data['api'] : null;
            $update->username = $data['username'] ? $data['username'] : null;
            $update->password = $data['password'] ? $data['password'] : null;
            $update->facebook = $data['facebook'] ? $data['facebook'] : null;
            $update->twitter = $data['twitter'] ? $data['twitter'] : null; 
            $update->youtube = $data['youtube'] ? $data['youtube'] : null;
            $update->instagram = $data['instagram'] ? $data['instagram'] : null;
            $update->googleplus = $data['googleplus'] ? $data['googleplus'] : null;

            if($request->file('logo')){
                ImageUpload($request->file('logo'));
            }

            $update->save();

            return redirect()->back()->with("success","Systems updated successfully.");

        } catch(Exception $e) {
            return redirect()->back()->with("error",$e->getMessage());
        }
    }


    public function profileUpdate(Request $request)
    {
        $data = $request->all();
        try {
            $update = User::find(auth()->user()->id);
            $update->email = $data['email'];
            $update->name = $data['name'];
            $update->save();

            return redirect()->back()->with("success","Profile updated successfully.");
            
        } catch(Exception $e){
            return redirect()->back()->with("error","error");
        }
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