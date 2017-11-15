<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;
use App\SystemSetting;
use Mail;

use App\Mail\CustomCampaign;

class EmailController extends Controller
{
    
    public function send(Request $request) 
    {
        $datas = $request->except('_token');
        
        if($datas['req'] == 'mail')
        {
            $settings = SystemSetting::find(1);
            $listings = Subscriber::where('status','=',1)->where('user_list_id','=',$datas['user_list_id'])->get();

            $data['subject'] = $datas['subject'];
            $data['content'] = $datas['message'];
            $data['settings'] = $settings;

            if($settings && count($settings) < 1) {
                return "Message cannot complete. Please do your settings before sending.";
            } 

            try {
                ini_set('max_execution_time', 900);
                $time_start = microtime(true);

                if($listings){
                    //sending message based on server limit
                    $count=0;
                    foreach($listings as $key => $ut){
                        Mail::to($ut['email'])->send(new CustomCampaign($data));
                        if($count == (int)config('constants.SUBSCRIBER_LIMIT')){break;}
                        $count++;
                    }
                    
                    $time_end = microtime(true);
                    $time = ($time_end - $time_start)/60;
        
                    return $time;
                } else {

                }

            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }
}
