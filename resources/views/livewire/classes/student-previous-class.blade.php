
@section('header') Previous Class | {{ $student->full_name }} @endsection
<div wire:id="student" class="content-wrapper">
    <div class="container">
        <div class="main-body">
            <div class="card">
                <div class="card-header">
                    {{ $student->full_name }} | {{ $class->name }}
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="row border-bottom border-danger py-3 col-12">
                            <div class="col-6">Academic Position</div>
                            <div class="col-6">{{ $studentClassRecord->academic_position }}</div>
                        </div>

                        <div class="row border-bottom border-danger py-3 col-12">
                            <div class="col-6">Overall Raw Score</div>
                            <div class="col-6">{{ $studentClassRecord->overall_raw_score }}</div>
                        </div>

                        @foreach($studentClassRecord->fetched_semesters as $semester)
                            <div class="col-12 mt-4">
                                <div class="mb-1 text-center">
                                    {{ $semester->name }}
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Subject </th>
                                            <th> Class Score </th>
                                            <th> Exam Score </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($student->classScores->where('semester_id', $semester->id)->where('class__id', $studentClassRecord->class__id) as $class_score)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td> {{ $class_score->subject->name }} </td>
                                                <td> {{ $class_score->class_score }} </td>
                                                <td> {{ $class_score->exam_score }} </td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


