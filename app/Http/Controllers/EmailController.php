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

        // $mail = new PHPMailer;                              // Passing `true` enables exceptions
        // try {
        //     //Server settings
        //     $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        //     $mail->isSMTP();                                      // Set mailer to use SMTP
        //     $mail->Host = 'smtp.mailtrap.io';                       // Specify main and backup SMTP servers
        //     $mail->SMTPAuth = true;                               // Enable SMTP authentication
        //     $mail->Username = '3d7504a2bedc3d';                 // SMTP username
        //     $mail->Password = '6c1205c12632af';                 // SMTP password
        //     $mail->SMTPSecure = null;                            // Enable TLS encryption, `ssl` also accepted
        //     $mail->Port = 465;                                    // TCP port to connect to
        
        //     //Recipients
        //     $mail->setFrom('from@example.com', 'Mailer');
        //     $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        //     $mail->addAddress('ellen@example.com');
        //     $mail->addAddress('destinyajakaiye@gmail.com');               // Name is optional
        //     $mail->addReplyTo('info@example.com', 'Information');
        //     $mail->addCC('cc@example.com');
        //     $mail->addBCC('bcc@example.com');
        
        //     //Content
        //     $mail->isHTML(true);                                  // Set email format to HTML
        //     $mail->Subject = 'Here is the subject';
        //     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        //     if($mail->send()){
        //         return redirect()->back()->with('success',"Sending completed in");
        //     }
        // } catch (Exception $e) {
        //     echo 'Message could not be sent.';
        // }

        try {
            ini_set('max_execution_time', 300);
            
            //calculating execution time
            $time_start = microtime(true);
            $when = \Carbon\Carbon::now()->addMinutes(3);

            $users = [];
            foreach($listings as $key => $ut){
              $ua = [];
              $ua['email'] = $ut['email'];
              $ua['name'] = 'test';
              $users[$key] = (object)$ua;
            }

            Mail::to($users)->later($when, new CustomCampaign($data));

            // if(!$datas['address']){
            //     foreach($listings as $listing){
            //         $GLOBALS['list'] = $listing['email'];
            //         // Mail::to($GLOBALS['list'])->later($when, new CustomCampaign($data));
            //     }
            //     Mail::to($GLOBALS['list'])->later($when, new CustomCampaign($data));
            // } else {
            //     // $convert = implode(',', $datas['address']);
            //     // $recipients = explode(',', $convert);
            //     // Mail::to($recipients)->later($when, new CustomCampaign($data));
            //     // // foreach($recipients as $key => $v) {
            //     // //     Mail::to($v)->later($when, new CustomCampaign($data));
            //     // // } 
            //     foreach($listings as $listing){
            //         $GLOBALS['list'] = $listing['email'];
            //         // Mail::to($GLOBALS['list'])->later($when, new CustomCampaign($data));
            //     }
            //     Mail::to($GLOBALS['list'])->later($when, new CustomCampaign($data));
            // }

            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start)/60;

            return redirect()->back()->with('success',"Sending completed in $execution_time Mins");
                
        } catch(Exception $e) {
            return redirect()->back()->with("error","Error");
        }
    }
}
