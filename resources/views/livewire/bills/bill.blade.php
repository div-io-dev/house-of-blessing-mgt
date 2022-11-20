
@section('header') Bills @endsection
<div wire:id="fees" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-6">Bill Code</div>
                        <div class="col-6 text-success">{{ $bill->bill_code }}</div>
                    </div>
                    <hr style="background:#505050;">
                    <div class="row">
                        <div class="col-6">Date</div>
                        <div class="col-6">{{ $bill->created_at }}</div>
                    </div>
                    <hr style="background:#505050;">
                    <div class="row">
                        <div class="col-6">Amount</div>
                        <div class="col-6">{{ $bill->amount }}</div>
                    </div>
                    <hr style="background:#505050;">
                    <div class="row">
                        <div class="col-6">Amount Paid</div>
                        <div class="col-6 text-success">{{ $bill->amount_paid }}</div>
                    </div>
                    <hr style="background:#505050;">
                    <div class="row">
                        <div class="col-6">Amount Left</div>
                        <div class="col-6 @if($bill->amount_left > 0) text-danger @endif ">{{ $bill->amount_left }}</div>
                    </div>
                    <hr style="background:#505050;">
                    <div class="row">
                        <div class="col-6">For</div>
                        <div class="col-6">{{ $billable->full_name }}</div>
                    </div>
                    @if($billable->class)
                        <hr style="background:#505050;">
                        <div class="row">
                            <div class="col-6">Class</div>
                            <div class="col-6">
                                <a href="{{ route('classes.class', $billable->class->id) }}">
                                    {{ $billable->class->name }}
                                </a>
                            </div>
                        </div>
                    @endif
                    <hr style="background:#505050;">
                    <div class="row">
                        <div class="col-6">Type / Name</div>
                        <div class="col-6">{{ strtoupper($bill->type) ?? 'not specified' }}</div>
                    </div>
                    @if($bill->fee)
                        <hr style="background:#505050;">
                        <div class="row">
                            <div class="col-3">Fee</div>
                            <div class="row col-9 text-sm">
                                @foreach($bill->fee->items as $item)
                                    <div class="col-6">{{ $item['name'] }}</div>
                                    <div class="col-6">{{ $item['price'] }}</div>
                                    <div class="col-12" style="height: 25px; padding-top: 0px;"><hr class="bg-danger"></div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <hr style="background:#505050;">
                    <div class="row">
                        <div class="col-6">Created By</div>
                        <div class="col-6">{{ $bill->added_by_name }}</div>
                    </div>
                    <hr style="background:#505050;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4"><h3>Payments</h3></div>
                        <div class="col-4">
                            <button data-toggle="modal" data-target="#makePaymentModal" class="btn btn-outline-secondary">Make payment</button>
                        </div>
                        <div class="col-4">
                            <a target="_blank" href="{{ route('bills.bill.payments.invoice', $bill->id) }}" class="btn btn-outline-primary">Generate invoice</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($payments) < 1)
                            No payment yet
                        @else
                            <table class="table table-dark text-sm">
                                <thead>
                                <tr>
                                    <th> Amount Paid </th>
                                    <th> Paid By </th>
                                    <th> Mobile Number </th>
                                    <th> Received By </th>
                                    <th> Received On </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td> {{ $payment->amount_paid }} </td>
                                        <td> {{ $payment->payer_name }} </td>
                                        <td> {{ $payment->payer_mobile_number ?? '------------' }} </td>
                                        <td> {{ $payment->added_by_name }} </td>
                                        <td> {{ $payment->formatted_created_at }} </td>
                                        <td>
                                            <a href="{{ route('bills.bill.payment.invoice', $payment->id) }}" target="_blank" class="btn btn-sm btn-outline-warning">Generate invoice</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="makePaymentModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="makePaymentModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make Payment</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="makePayment" id="make_payment_form">
                        <div class="form-group">
                            <label for="amount">Amount <sup class="text-danger">*</sup></label>
                            <input required wire:model.defer="amount" type="text" class="form-control" id="amount">
                            @error('amount')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="payer_name">Payer Name<sup class="text-danger">*</sup></label>
                            <input required wire:model.defer="payer_name" type="text" class="form-control" id="payer_name">
                            @error('payer_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="payer_mobile_number">Payer Mobile Number</label>
                            <input wire:model.defer="payer_mobile_number" type="text" class="form-control" id="payer_mobile_number">
                            @error('payer_mobile_number')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="make_payment_form" class="btn btn-primary">Make payment</button>
                </div>
            </div>
        </div>
    </div>


</div>
