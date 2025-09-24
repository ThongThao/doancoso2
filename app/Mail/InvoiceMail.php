<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bill;
use App\Models\BillInfo;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $billItems;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bill $bill, $billItems)
    {
        $this->bill = $bill;
        $this->billItems = $billItems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Hóa đơn đơn hàng #' . $this->bill->idBill)
                    ->view('emails.invoice')
                    ->with([
                        'bill' => $this->bill,
                        'billItems' => $this->billItems
                    ]);
    }
}
