<?php

namespace App\Http\Livewire\Bills;

use App\Services\BillService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Bill as BIllModel;
use Arhinful\LaravelMnotify\MNotify;
use Velstack\Mnotify\Notifications\Notify;

class Bill extends Component
{
    use LivewireAlert;

    public BIllModel $bill;
    public $billable;
    public $payments;

    public $amount;
    public $payer_name;
    public $payer_mobile_number;

    public function render()
    {
        $this->billable = $this->bill->billable_type::where('id', $this->bill->billable_id)->first();
        $this->payments = $this->bill->billPayments()->orderBy('created_at', 'DESC')->get();
        return view('livewire.bills.bill');
    }

    public function makePayment(){
        $this->validate([
            'payer_name' => 'required|string',
            'payer_mobile_number' => 'nullable|string',
            'amount' => 'required',
        ]);
        if ($this->bill->amount_left < 1){
            $this->alert(message: "Bill has already been settled");
            return;
        }
        $payer = [
            'name' => $this->payer_name,
            'mobile_number' => $this->payer_mobile_number,
        ];
        $bill = (new BillService())->pay($this->bill, $this->amount, $payer);
        $this->alert(message: "Bill paid successfully");
        //sending bill notification
        $destinationPhone = $this->payer_mobile_number;
        $amountPaid = $this->amount;
        $amount_left= $bill->amount_left;


        Notify::sendQuickSMS([$destinationPhone],
            "Thank you, We have received your payment of GHS$amountPaid for School Fees at House of Blessing School. You have a balance of GHS$amount_left to settle.");



        $this->reset(['payer_name', 'payer_mobile_number', 'amount']);
    }

}
