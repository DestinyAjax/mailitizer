<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;
use Excel;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['subscribers'] = Subscriber::all();
       
        return view('admin.subscribers.index')->with($data);
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

    //email validation function
    protected function validator(array $data) {
        return \Validator::make($data, [
            'email' => 'email|max:255',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $email = explode(',', $data['email']);
        try {
            ini_set('max_execution_time', 300);

            foreach($email as $e)
            {
                $d = ['email' => $e];
                $validator = $this->validator($d);
                $check = Subscriber::hasEmail($d['email']);
                if(!$check){
                    if($validator->fails()) {
                        //insert invalid email addresses
                        $invalid = new Subscriber();
                        $invalid->email = $d['email'];
                        $invalid->status = 2;
                        $invalid->save();
                    } else {
                        $valid = new Subscriber();
                        $valid->email = $d['email'];
                        $valid->status = 1;
                        $valid->save();
                    }
                } else {}
            }

            return redirect()->back()->with("success","Request success");
        } catch(Exception $e) {
            return redirect()->back()->with("error",$e->getMessage());
        }
    }


    public function uploadSubscribers(Request $request)
    {
        if($request->hasFile('subscribers')){
            $path = $request->file('subscribers')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            try {
                ini_set('max_execution_time', 300);

                //calculating execution time
                $time_start = microtime(true);

                if(!empty($data) && $data->count()){
                    foreach ($data->toArray() as $v) {
                        if(!empty($v)){      
                            $d = ['email' => $v['email']];
                            $validator = $this->validator($d);
                            $check = Subscriber::hasEmail($d['email']);
                            
                            //check if email already exist
                            if(!$check) {
                                if($validator->fails()) {
                                    //insert invalid email addresses
                                    $invalid = new Subscriber();
                                    $invalid->email = $d['email'];
                                    $invalid->status = 2;
                                    $invalid->save();
                                } else {
                                    //insert valid email addresses
                                    $valid = new Subscriber();
                                    $valid->email = $d['email'];
                                    $valid->status = 1;
                                    $valid->save();
                                } 
                            } else {} 
                        }
                    }
                } else { return redirect()->back()->with("error","Error! There's something wrong with the file your uploaded."); }

                $time_end = microtime(true);
                //dividing with 60 will give the execution time in minutes other wise seconds
                $execution_time = ($time_end - $time_start)/60;

                return redirect()->back()->with('success',"Upload Completed successfully in $execution_time Mins");

            } catch(Exception $e) {
                return redirect()->back()->with("error",$e->getMessage());
            }
        } else { return redirect()->back()->with("error","Invalid Request"); }
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
