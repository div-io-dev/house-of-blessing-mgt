@section('header') Students Owing @endsection
<div wire:id="owe" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3"><h4 class="card-title">Students Owing Fees</h4></div>
                        <div class="col-3">
                            <button class="btn btn-success btn-sm" onclick="printDiv('print_container')">Print</button>
                        </div>
                    </div>
                    <div class="col-12 grid-margin stretch-card">

                        <div class="table-responsive" id="print_container">
                            @if(count($students) < 1)
                                <div class="mt-5">
                                    <h4>Oops!, there are no students owing</h4>
                                </div>
                            @else
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Class </th>
                                        <th> Amount Left </th>
                                        <th> <span class="underline">No</span> of fess </th>
{{--                                        <th></th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                {{ "$student->first_name $student->last_name"}}
                                                <p>{{ $student->other_names }}</p>
                                            </td>
                                            <td>
                                                {{ $student->class->name }}
                                            </td>
                                            <td>
                                                GHS {{ $student->fees_amount_left }}
                                            </td>
                                            <td>
                                                {{ $student->num_of_fees_owing }} fee @if(count($student->fees_owing) > 1)<span>s</span>@endif
                                                @foreach($student->fees_owing as $bill)
                                                    <div class="p-1">{{ $bill->fee->semester->name }} - {{ $bill->amount_left }}</div>
                                                @endforeach
                                            </td>
{{--                                            <td> <a href="{{ route('students.student', 1) }}">--}}
{{--                                                    <i class="mdi mdi-eye"></i> view info--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
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
</div>
