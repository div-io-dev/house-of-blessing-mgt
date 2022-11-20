
@section('header') Fee History | {{ $semester->name }} @endsection
<div wire:id="fee_history" class="content-wrapper" style="color: rgba(196,196,196,0.79)">


    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h5>{{ $semester->name }} Fee</h5>
            <h6>Total Amount: {{ $fee_info['total_amount'] }}</h6>
            <h6>Total Amount Paid: {{ $fee_info['amount_paid'] }}</h6>
            <h6>Total Amount Left: {{ $fee_info['debt'] }}</h6>
            <h6>{{ $fee_info['students_owing_count'] }} students owing</h6>
        </div>
    </div>


    <div class="col-12 grid-margin stretch-card">
        <div class="table-responsive">
            @if(count($students) < 1)
                <div class="mt-5">
                    <h4>Oops!, there are no students in school DB, please add a new student</h4>
                </div>
            @else
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Amount Paid </th>
                        <th> Amount Left </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <a href="{{ route('students.student', $student->id) }}" target="_blank">
                                    {{ "$student->first_name $student->last_name"}}
                                </a>
                                <p>{{ $student->other_names }}</p>
                            </td>
                            <td class="text-success"> {{ $student->fee_nfo['amount_paid'] }} </td>
                            <td class="text-danger"> {{ $student->fee_nfo['amount_left'] }} </td>
                            <td class="text-danger">
                                @if(!is_null($student->fee_nfo['id']))
                                    <a href="{{ route('bills.bill', $student->fee_nfo['id']) }}" class="btn btn-sm btn-primary">Bill info</a>
                                @else
                                    Student was not billed
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>



    </div>


</div>

