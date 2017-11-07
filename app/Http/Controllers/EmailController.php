<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;
use App\SystemSetting;
use Mail;

// use PHPMailer\PHPMailer\PHPMailer;
// // use PHPMailer\PHPMailer\Exception;

use App\Mail\CustomCampaign;

class EmailController extends Controller
{
    
    public function send(Request $request) 
    {
        $datas = $request->all();
        $settings = SystemSetting::find(1);
        $listings = Subscriber::where('status','=',1)->get();
        $data['subject'] = $datas['subject'];
        $data['content'] = $datas['message'];
        $data['settings'] = $settings;

        if($settings && count($settings) < 1) {
            return redirect()->back()->with("Error","Message cannot complete. Please do your settings before sending.");
        } 

        try {
            ini_set('max_execution_time', 300);
            
            //calculating execution time
            $time_start = microtime(true);
            $when = \Carbon\Carbon::now()->addMinutes(3);

            if($listings){
                //subscribers stored on the database
                $subscribers = [];
                foreach($listings as $key => $ut){
                  $ua = [];
                  $ua['email'] = $ut['email'];
                  $ua['name'] = 'Subscriber';
                  $subscribers[$key] = (object)$ua;
                }

                //subscribers enter manually
                if(!empty($datas['to'])){
                    $convert = implode(',', $datas['to']);
                    $recipients = explode(',', $convert);
                    foreach($recipients as $key => $v) {
                        $ua = [];
                        $ua['email'] = $v;
                        $ua['name'] = 'Subscriber';
                        array_push($subscribers, (object)$ua);
                    }
                }

                // dd($subscribers);
                Mail::to($subscribers)->later($when, new CustomCampaign($data));
                
                $time_end = microtime(true);
                $execution_time = ($time_end - $time_start)/60;
    
                return redirect()->back()->with('success',"Sending completed in $execution_time Mins");
            } else {

            }

        } catch(Exception $e) {
            return redirect()->back()->with("error","Error");
        }
    }
}
