
@section('header') Fees @endsection
<div wire:id="fees" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3"><h4 class="card-title">Fees ({{ count($fees) }})</h4></div>
                        <div class="col-3">
                            <a class="float_" href="{{ route('fees.create') }}">Create new fee</a>
                        </div>
                        <div class="col-3">
                            <a class="float_" href="{{ route('fees.payment') }}">Fee payment</a>
                        </div>
                        <div class="col-3">
                            <a class="float_" href="{{ route('fees.owe') }}">Owe</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(count($fees) < 1)
                            No fees was found
                        @else
                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Created on </th>
                                    <th> Semester </th>
                                    <th> Total Amount </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fees as $fee)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td> {{ $fee->created_at }} </td>
                                        <td> {{ $fee->semester->name }} </td>
                                        <td> <a href="{{ route('fees.fee', $fee->id) }}">view</a> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
{{--                    <div class="mt-2">--}}
{{--                        <a href="#" class="btn btn-success">View all</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
