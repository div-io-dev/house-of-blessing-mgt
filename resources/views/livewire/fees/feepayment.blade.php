
@section('header') Fee Payment @endsection
<div wire:id="fees" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header card-header-pills">
                    <div class="text-center">Fee Payment</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form wire:submit.prevent="pay" class="col-12 col-md-6 pr-0 pr-md-4">

                            <div class=" form-group">
                                <label for="student_id">Student ID</label>
                                <input wire:model.defer="student_number" wire:keyup="fetchStudentInfo" type="text" maxlength="8" class="form-control">
                                @error('student_number')<span class="text-danger text-small">{{ $message }}</span> @enderror
                                <span id="student_number_error" class="text-danger text-small"></span>
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input wire:model.defer="amount" id="amount" type="text" class="form-control">
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

                            <div class="row form-group px-3">
                                <button id="pay_btn" type="submit" class="btn btn-success w-50">
                                    <i id="pay_btn_loader" class="mdi mdi-loading mdi-spin text-white hidden"></i>
                                    <span id="pay_btn_text">Pay</span>
                                </button>
                            </div>
                        </form>
                        <div class="col-12 col-md-6 pl-md-4 pl-0 mt-5 mt-md-0">
                            <div class="form-group">
                                <label for="amount">Name | Class</label>
                                <input disabled type="text" value="{{ $student_name_n_class }}" class="form-control text-dark">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount Owing</label>
                                <input disabled type="text" id="amount_owing" value="{{ $amount_owning }}" class="form-control text-dark">
                            </div>
                        </div>
                    </div>
                    <hr style="background:#4e4e4e;">
                    <div>
                        <h4>Bills (School fees only)</h4>

                        <div class="col-12 grid-margin stretch-card">
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th> Date </th>
                                        <th> Total Amnt. </th>
                                        <th>Amnt. Paid</th>
                                        <th>Amnt. Remaining</th>
                                        <th>Bill Type</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="table_body">
                                    @foreach($student_bills as $bill)
                                        <tr>
                                            <td>{{ $bill->formatted_created_at }}</td>
                                            <td>{{$bill->amount}}</td>
                                            <td>{{$bill->amount_paid}}</td>
                                            <td>{{$bill->amount_left}}</td>
                                            <td>{{$bill->type}}</td>
                                            <td><a href='{{ route('bills.bill', $bill->id) }}' class='btn btn-info btn-sm'>info</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
