<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;
use App\SystemSetting;

class EmailController extends Controller
{
    

    public function send(Request $request) 
        {
            $title = $request->get('title');
            $content = $request->get('message');
            $settings = SystemSetting::first();

            if($settings && count($settings) < 1) {
                return redirect()->back()->with("Error","Message cannot complete. Please do your settings before sending.");
            } else {
                $GLOBALS['name'] = $settings['sender_name'];
                $GLOBALS['email'] = $settings['sender_email'];
            }

            $listings = Subscriber::where('status','=',1)->get();
            try {
                ini_set('max_execution_time', 300);
                
                //calculating execution time
                $time_start = microtime(true);
                foreach($listings as $listing){
                    $GLOBALS['list'] = $listing['email'];
                    \Mail::send('emails.custom', ['title' => $title, 'content' => $content], function($message) {
                        $message->from($GLOBALS['email'],$GLOBALS['name']);
                        $message->to($GLOBALS['list']); 
                    });
                }

                $time_end = microtime(true);
                //dividing with 60 will give the execution time in minutes other wise seconds
                $execution_time = ($time_end - $time_start)/60;

                return redirect()->back()->with('success',"Sending completed in $execution_time Mins");
                    
            } catch(Exception $e) {
                return redirect()->back()->with("error","Error");
            }

            // return response()->json(['message' => 'Request completed']);
    }
}
