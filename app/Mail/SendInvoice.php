<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;
    public $client_code;
    public $from_date;
    public $to_date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdfPath, $from_date, $to_date, $client_code)
    {
        $this->pdfPath = $pdfPath;
        $this->client_code = $client_code;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = "phwc-service-invoice-{$this->client_code}-{$this->from_date}-to-{$this->to_date}";
        return $this->view('emails.send_invoice')
            ->subject("Service Invoice for Client")
            ->attachFromStorageDisk('public', $this->pdfPath, "{$name}.pdf", [
                'mime' => 'application/pdf'
            ]);
    }
}
