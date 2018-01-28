<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\SystemSetting;
use App\Template;

class CustomCampaign extends Mailable
{
    use Queueable, SerializesModels;

    protected $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = Template::where('status','=',2)->first();
        $settings = SystemSetting::find(1);
        return $this->view('emails.'.$template->slug)->with($this->content)
                    ->from(config('constants.SENDER_EMAIL'), config('constants.SENDER_NAME'))
                    // ->bcc($this->content['subscribers'])
                    ->replyTo($settings['sender_email'], $settings['sender_name'])
                    ->subject($this->content['subject']);
    }
}
