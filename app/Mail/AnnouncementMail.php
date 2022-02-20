<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;


    public $announcement;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($announcement)
    {
        $this->announcement = $announcement;
        // $this->url = env('APP_URL') . "/announcement/$announcement->slug";
        $this->url = url("/announcement/$announcement->slug");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('📢 Announcement - ' . $this->announcement->title)
            ->markdown('emails.announcement',  ['announcement' => $this->announcement ,'url' => $this->url]);
    }
}
