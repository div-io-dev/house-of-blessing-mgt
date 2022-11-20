
@section('header') Class Scores @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="row">
        <div class="row col-12 text-center">
            <div class="col-12">
                <h4 class="card-title">{{ $class->name }}</h4>
            </div>
            <div class="col-12">
                <h4 class="card-title">{{ $semester->name }}</h4>
            </div>
            <div class="col-12">
                <h4 class="card-title">{{ $subject->name }}</h4>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" id="print_container">
                            @if(count($class_scores) > 0)
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Name </th>
                                        <th> Class Score </th>
                                        <th> Exams Score </th>
                                        <th> Total Score </th>
                                        <th> Position </th>
                                        <th>
                                            <button class="btn btn-success btn-sm" onclick="printDiv('print_container')">print</button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($class_scores as $class_score)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>
                                                {{ "{$class_score->student->first_name} {$class_score->student->last_name}" }}
                                                <br> {{ $class_score->student->other_names }}
                                            </td>
                                            <td> {{ $class_score->class_score }} </td>
                                            <td> {{ $class_score->exam_score }} </td>
                                            <td> {{ $class_score->class_score + $class_score->exam_score }} </td>
                                            <td> {{ $class_score->student_position }} </td>
                                            @if(!$class_score->is_locked)
                                                <td>
                                                    <button data-toggle="modal" data-target="#editModal_{{$class_score->id}}" class="btn btn-sm btn-primary">Edit</button>
                                                </td>
                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal_{{$class_score->id}}" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="editModal_{{$class_score->id}}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="row modal-header">
                                                                <div class="col-12">
                                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="col-12 text-center">
                                                                    <h6 class="modal-title">Edit Class Score</h6>
                                                                </div>
                                                                <div class="col-12 text-center">
                                                                    <h4 class="modal-title">{{ $class_score->student->full_name }}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="forms-sample" method="POST"  action="{{ route('class_scores.update', $class_score->id) }}" id="update_class_score_form_{{$class_score->id}}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="class_score">Class Score</label>
                                                                        <input value="{{ $class_score->class_score }}" name="class_score" type="text" class="form-control" id="class_score">
                                                                        @error('class_score')<span class="text-danger text-small">{{ $message }}</span> @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exam_score">Exams Score</label>
                                                                        <input name="exam_score" value="{{ $class_score->exam_score }}" type="text" class="form-control" id="exam_score">
                                                                        @error('exam_score')<span class="text-danger text-small">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" form="update_class_score_form_{{$class_score->id}}" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <form method="POST" action="{{ route('class_scores.lock_subject_scores', ['subject' => $subject->id, 'class' => $class->id, 'semester' => $semester->id])}}" class="mt-2">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">lock scores</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>






        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">Other Semesters</div>
                    <div class="card-body">
                        <ul>
                            @foreach($previous_class_scores as $semester => $previous_class_score)
                                <li class="my-2">
                                    <a href="{{ route('class_scores.class_subject_scores', ['class' => $class->id, 'subject' => $subject->id, 'semester' => $semester]) }}">
                                        {{ app\Models\Semester::where('id', $semester)->first()->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>






    </div>

</div>
