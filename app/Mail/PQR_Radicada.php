<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PQR_Radicada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id_pqr;
    public function __construct($id_pqr)
    {
        $this->id_pqr = $id_pqr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('quiku2023@hotmail.com')->view('intranet.emails.pqr_radicada_mail')->with(['id_pqr' => $this->id_pqr,]);
    }
}
