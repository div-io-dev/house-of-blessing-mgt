<?php

namespace App\Http\Livewire\Bills;

use App\Services\BillService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use \App\Models\Bill as BillModel;
use Arhinful\LaravelMnotify\MNotify;

class Pay extends Component
{
    use LivewireAlert;

    public $bill_code;
    public $amount;
    public $payer_name;
    public $payer_mobile_number;
    public $bill_info = '';

    public function render()
    {
        return view('livewire.bills.pay');
    }

    public function fetchBillInfo(){
        if (strlen($this->bill_code) != 8){
            $this->bill_info = '';
            return;
        }
        $this->validate([
            'bill_code' => 'exists:bills,bill_code'
        ]);
        $bill = BillModel::where('bill_code', $this->bill_code)->first();
        $billable = $bill->billable_type::where('id', $bill->billable_id)->first();
        $class_name = '-';
        if ($billable->class) $class_name = $billable->class->name;
        $this->bill_info = "$billable->full_name | $class_name | $bill->type - Total: $bill->amount Left: $bill->amount_left";
    }

    public function pay(){
        $this->validate([
            'bill_code' => 'required|exists:bills,bill_code',
            'payer_name' => 'required|string',
            'payer_mobile_number' => 'nullable|string',
            'amount' => 'required',
        ]);
        $bill = BillModel::where('bill_code', $this->bill_code)->first();
        if ($bill->amount_left < 1){
            $this->alert(message: "Bill has already been settled");
            return;
        }
        $payer = [
            'name' => $this->payer_name,
            'mobile_number' => $this->payer_mobile_number,
        ];
        $bill = (new BillService())->pay($bill, $this->amount, $payer);
        $this->alert(message: "Bill paid successfully");

        //sending bill notification
        $destinationPhone = $this->payer_mobile_number;
        $amountPaid = $this->amount;
        $amount_left= $bill->amount_left;

        $sender= new MNotify();
        $sender->sendQuickSMS([$destinationPhone], "Thank you, We have received your payment of GHS$amountPaid for School Fees at House of Blessing School. You have a balance of GHS$amount_left to settle.");





        $this->reset(['payer_name', 'payer_mobile_number', 'amount']);
        $this->fetchBillInfo();
    }
}
