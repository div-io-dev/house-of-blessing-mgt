
@section('header') Pay Bill @endsection
<div wire:id="fees" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div><h3>Pay Bill</h3></div>
                    <div><hr class="bg-danger"></div>

                    <form class="forms-sample" wire:submit.prevent="pay">
                        <div class="form-group">
                            <label for="bill_code">Bill code</label>
                            <input wire:model="bill_code" wire:keyup="fetchBillInfo"  id="bill_code" maxlength="8" type="text" class="form-control">
                            <span class="text-success text-small">{{ $bill_info }}</span>
                            @error('bill_code')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input id="amount" wire:model="amount" type="text" class="form-control">
                            @error('amount')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="payer_name">Payer Name</label>
                            <input id="payer_name" wire:model="payer_name" type="text" class="form-control">
                            @error('payer_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="payer_mobile_number">Payer Mobile number</label>
                            <input id="payer_mobile_number" wire:model="payer_mobile_number" type="text" class="form-control">
                            @error('payer_mobile_number')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="row form-group">
                            <button class="btn btn-primary" type="submit">Make payment</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
