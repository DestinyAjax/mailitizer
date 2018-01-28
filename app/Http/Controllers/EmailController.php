<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;
use App\SystemSetting;
use Mail;
use App\Template;

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
            $template = Template::where('status','=',2)->first();

            if(!$template){
                return $response = [
                    'msg' => "Please activate an out-going mail template before continuing.",
                    'type' => "false"
                ];
            }

            if($settings && count($settings) < 1) {
                return $response = [
                    'msg' => "Failed! Please complete your settings before sending.",
                    'type' => "false"
                ];
            } 

            try {
                exec("php artisan queue:work --daemon --tries=3");
                ini_set('max_execution_time', 0);
                $time_start = microtime(true);

                if(count($listings) < 1){
                    return $response = [
                        'msg' => "Failed! Mailing list is empty",
                        'type' => "false"
                    ];
                } else{
                    //sending message based on server limit
                    $count=1;
                    foreach($listings as $key => $ut){
                        Mail::to($ut['email'])->queue(new CustomCampaign($data));
                        if($count == (int)config('constants.SUBSCRIBER_LIMIT')){break;}
                        $count++;
                    }
                    
                    $time_end = microtime(true);
                    $time = ($time_end - $time_start)/60;

                    return $response = [
                        'msg' => "Completed in $time minutes",
                        'type' => "true"
                    ];
                } 

            } catch(Exception $e) {
                return $response = [
                    'msg' => "Internal Error Occur",
                    'type' => "false"
                ];
            }
        }
    }
}
