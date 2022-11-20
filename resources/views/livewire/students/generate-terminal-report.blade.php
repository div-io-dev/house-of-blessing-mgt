
@section('header') Students @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h3>{{ $student->full_name }} | Generate Terminal report</h3>
        </div>
        <div class="row col-12 grid-margin stretch-card">
            <div class="col-12 my-2">
                <button class="btn btn-success btn-sm" onclick="printDiv('print_container')">Generate report</button>
            </div>
            <div class="row w-full" id="print_container">
                <div class="col-12 text-center my-2">
                    {{ strtoupper($student->full_name) }}'s Terminal Report | {{ currentSemester()->name }}
                </div>

                <div class="col-12">

                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th> Subject </th>
                                <th> Class Score </th>
                                <th> Exams Score </th>
                                <th> Total Score </th>
                                <th> Position </th>
                                <th> Interpretation </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->class_score->class_score }}</td>
                                    <td>{{ $subject->class_score->exam_score }}</td>
                                    <td>{{ $subject->class_score->exam_score + $subject->class_score->class_score }}</td>
                                    <td>{{ $subject->class_score->student_position }}</td>
                                    <td>Good</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="font-weight-bold">Total Remarks</td>
                                <td></td>
                                <td></td>
                                <td class="font-weight-bold">{{ $total_remarks }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-5 ml-6 pl-5">

                        <div class="col-12">
                            Aggregate Of The Best Six Results ......................................................................................................................................
                        </div>

                        <div class="col-12 mt-4">
                            Attendance ...................................... out of .......................................
                        </div>

                        <div class="col-12 mt-4">
                            Conduct ......................................................................................................................................
                        </div>

                        <div class="col-12 mt-4">
                            Interest ......................................................................................................................................
                        </div>

                        <div class="col-12 mt-4">
                            Class Teacher's Remark ......................................................................................................................................
                        </div>

                        <div class="col-12 mt-4">
                            Head Teacher's Remark ......................................................................................................................................
                        </div>

                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th> Bill Code </th>
                                <th> Amount </th>
                                <th> Amount Paid </th>
                                <th> Amount Left </th>
                                <th> Type </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bills as $bill)
                                <tr>
                                    <td>{{ $bill->bill_code }}</td>
                                    <td>GHS {{ $bill->amount }}</td>
                                    <td>GHS {{ $bill->amount_paid }}</td>
                                    <td>GHS {{ $bill->amount_left }}</td>
                                    <td>{{ $bill->type }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="font-weight-bold">Total</td>
                                <td class="font-weight-bold">{{ $bills->sum('amount') }}</td>
                                <td class="font-weight-bold">{{ $bills->sum('amount_paid') }}</td>
                                <td class="font-weight-bold">{{ $bills->sum('amount_left') }}</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

