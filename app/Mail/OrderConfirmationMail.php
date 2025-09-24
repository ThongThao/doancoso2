<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bill;
use App\Models\BillInfo;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $billItems;
    public $confirmUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bill $bill, $billItems, $confirmUrl)
    {
        $this->bill = $bill;
        $this->billItems = $billItems;
        $this->confirmUrl = $confirmUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Xác nhận đơn hàng #' . $this->bill->idBill)
                    ->view('emails.order_confirmation')
                    ->with([
                        'bill' => $this->bill,
                        'billItems' => $this->billItems,
                        'confirmUrl' => $this->confirmUrl
                    ]);
    }
}
