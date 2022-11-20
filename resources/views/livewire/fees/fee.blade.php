
@section('header') Fee | {{ $semester->name }} @endsection
<div wire:id="fee" class="content-wrapper" style="color: rgba(196,196,196,0.79)">


    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h5>{{ $semester->name }} Fee</h5>
            <h6>Total Amount: {{ $bills->sum('amount') }}</h6>
            <h6>Collected So Far: {{ $fee_debt['collected_so_far'] }}</h6>
            <h6>Debt: {{ $fee_debt['total_debt'] }} ({{ $fee_debt['students_owing_count'] }} out of {{ $fee_debt['total_students'] }} Students are owing)</h6>
            <a class="btn btn-success btn-sm ml-3" href="{{ route('fees.edit', $fee->id) }}">Update</a>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header font-weight-bolder">Items</div>
                    <div class="card-body">
                        @foreach($fee->items as $item)
                            <div class="row">
                                <div class="col-6">{{ $item['name'] }}</div>
                                <div class="col-6">{{ $item['price'] }}</div>
                            </div>
                            <hr style="background:#505050;">
                        @endforeach
                        <div class="row text-danger">
                            <div class="col-6">Total</div>
                            <div class="col-6">{{ $fee->total_amount }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card bg-transparent">
                    <div class="card-header font-weight-bolder">Classes and Payment</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($classes as $class)
                                <div class="col-md-6 col-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="{{ route('classes.class', $class->id) }}">
                                                    {{ $class->name }} ({{ count($class->students) }} Students)
                                                </a>
                                            </h4>
                                            <div class="media">
                                                <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i>
                                                <div class="media-body">
                                                    <p class="card-text">
                                                        Total Amount: {{ $class->fee_info['total_amount'] }}
                                                    </p>
                                                    <p class="card-text">
                                                        Amount Paid: {{ $class->fee_info['amount_paid'] }}
                                                    </p>
                                                    <p class="card-text">
                                                        Class Debt: {{ $class->fee_info['debt'] }}
                                                    </p>
                                                    <p class="card-text">
                                                        Students Owing: {{ $class->fee_info['students_owing_count'] }}
                                                    </p>
                                                    <p>
                                                        <a href="{{ route('fees.class.payment_history', ['fee'=>$fee->id, 'class'=>$class->id]) }}" class="underline">
                                                            View Payment Info
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

