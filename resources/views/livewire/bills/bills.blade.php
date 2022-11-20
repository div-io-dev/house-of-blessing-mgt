
@section('header') Bills @endsection
<div wire:id="fees" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3"><h4 class="card-title">Bills ({{ count($bills) }})</h4></div>
                        <div class="col-3">
                            <span class="text-danger mr-2">Debt: {{ $bills->sum('amount_left') }}</span> |
                            <span class="text-success ml-2">Settled: {{ $bills->sum('amount_paid') }}</span>
                        </div>
                        <div class="col-3">
                            <a class="float_" href="{{ route('bills.create') }}">Create new bill</a>
                        </div>
                        <div class="col-3">
                            <a class="float_" href="{{ route('bills.pay') }}">Pay bill</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($bills) < 1)
                            No bills was found
                        @else
                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th> Student/Teacher </th>
                                    <th> Code </th>
                                    <th> Type/name </th>
                                    <th> Date </th>
                                    <th> Total Amnt. </th>
                                    <th> Amnt. Left</th>
                                    <th> Status </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bills as $bill)
                                    <tr>
                                        <td> {{ $bill->billable_type::where('id', $bill->billable_id)->first()->full_name }} </td>
                                        <td class="text-success"> {{ strtoupper($bill->bill_code) }} </td>
                                        <td> {{ strtoupper($bill->type) }} </td>
                                        <td> {{ $bill->formatted_created_at }} </td>
                                        <td> {{ $bill->amount }} </td>
                                        <td> {{ $bill->amount_left }} </td>
                                        <td>
                                            @if($bill->amount_left > 0)
                                                <span class="px-3 py-1 bg-danger text-white" style="border-radius: 5px">debt</span>
                                            @else
                                                <span class="px-3 py-1 bg-success text-white" style="border-radius: 5px">settled</span>
                                            @endif
                                        </td>
                                        <td> <a href="{{ route('bills.bill', $bill->id) }}">view more info</a> </td>
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
</div>
