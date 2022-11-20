<?php


namespace App\Services;


use App\Models\Bill;

class BillService
{
    public function store($billable, $amount, $type = null, $fee_id = null){
        $bill = Bill::create([
            'bill_code' => generateUniqueNumber("App\Models\Bill", "bill_code"),
            'amount' => $amount,
            'type' => $type,
            'fee_id' => $fee_id,
            'semester_id' => currentSemester()->id,
            'billable_id' => $billable->id,
            'billable_type' => get_class($billable),
        ]);
        return $bill;
    }

    public function pay($bill, $amount, array $payer){
        if ($amount < $bill->amount_left){
            $bill->update([
                'amount_paid' => $bill->amount_paid + $amount
            ]);
        }
        else{
            $bill->update([
                'amount_paid' => $bill->amount_paid + $bill->amount_left
            ]);
        }
        $bill->billPayments()->create([
            'amount_paid' => $amount,
            'payer_name' => $payer['name'],
            'payer_mobile_number' => $payer['mobile_number']
        ]);
        return $bill;
    }
}
