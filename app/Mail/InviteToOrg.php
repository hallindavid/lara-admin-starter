<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteToOrg extends Mailable
{
    use Queueable, SerializesModels;

    protected $from_name;
    protected $org_name;
    protected $to_name;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($to_name, $from_name, $org_name)
    {
        $this->to_name = $to_name;
        $this->from_name = $from_name;
        $this->org_name = $org_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.org_invite')->with([
            'from_name'=>$this->from_name,
            'org_name'=>$this->org_name,
            'to_name'=>$this->to_name
        ]);
    }
}
