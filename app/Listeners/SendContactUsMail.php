<?php

namespace App\Listeners;

use App\Events\ContactUs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactUsMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContactUs  $event
     * @return void
     */
    public function handle(ContactUs $event)
    {
        $dataArr=$event->data;
        unset($dataArr['_token']);
        unset($dataArr['submit']);
        $dataArr['created_at']=date('Y-m-d H:i:s');

        $record=\DB::table('contact_us')->insert($dataArr);
        $data['dataArr']=$dataArr;

        \Mail::send('emails.contact_us',$data,function($message) use ($data)
        {
            $message->subject('Contact Us from '.$data['dataArr']['full_name']);
            $message->to($data['dataArr']['email']);
        });
        return true;
    }
}
