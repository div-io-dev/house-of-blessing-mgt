
@section('header') Class @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="text-center"><h4 class="card-title">{{ $class->name }}</h4></div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4"><h4 class="card-title">Class Students</h4></div>
                            <div>
                                <button  class="btn btn-primary" data-toggle="modal" data-target="#editClassModal">Edit class</button>
                            </div>
                            <div>
                                <button  class="btn btn-inverse-success ml-2" data-toggle="modal" data-target="#attachSubjectModal">Attach a subject</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(count($class_students) > 0)
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Class Rating </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($class_students as $student)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>
                                                <a href="{{ route('students.student', $student->id) }}">
                                                    {{ "$student->first_name $student->last_name" }} <br> {{ $student->other_names }}
                                                </a>
                                            </td>
                                            <td> {{ $student->class_position }} </td>
                                            <td>
                                                <a target="_blank" href="{{ route('student.gen_terminal_report', ['student'=>$student->id, 'semester' => currentSemester()->id]) }}">
                                                    Gen. terminal rep.
                                                </a>
                                            </td>
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

        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4"><h4 class="card-title">Class Teachers</h4></div>
                        </div>
                        <div class="table-responsive">
                            @if(count($class_teachers) < 1)
                                No teacher for this class
                            @else
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th><span class="underline">No</span> of class subjects</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($class_teachers as $index => $teacher)
                                        <tr>
                                            <td>{{ $teacher->index+1 }}</td>
                                            <td> {{ $teacher->name }} </td>
                                            <td> {{ count($teacher->classes->where('id', $class->id)) }} </td>
                                            <td>
                                                <a href="{{ route('teachers.teacher', $teacher->id) }}"><i class="mdi mdi-eye mr-2"></i></a>
                                            </td>
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

        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4"><h4 class="card-title">Class Subjects</h4></div>
                        </div>
                        <div class="table-responsive">
                            @if(count($class_subjects) < 1)
                                No Subject for this class, please attach a subject
                            @else
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Teacher </th>
{{--                                        <th></th>--}}
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($class_subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->index+1 }}</td>
                                            <td> <a href="{{ route('class_scores.class_subject_scores', ['class' => $class->id, 'subject' => $subject, 'semester' => currentSemester()->id]) }}">{{ $subject->name }}</a> </td>
                                            <td> {{ $subject->teacher ? $subject->teacher->name : "No teacher assigned" }} </td>
                                            <td>
                                                @if($subject->teacher)
                                                    <button data-toggle="modal" data-target="#bindTeacherModal_{{ $subject->id }}" class="btn btn-sm btn-success"><i class="mdi mdi-update mr-2"> change teacher</i></button>
                                                @else
                                                    <button data-toggle="modal" data-target="#bindTeacherModal_{{ $subject->id }}" class="btn btn-sm btn-success"><i class="mdi mdi-link-variant mr-2"> bind teacher</i></button>
                                            @endif
                                                <!-- Bind Teacher Modal -->
                                                <div class="modal fade" id="bindTeacherModal_{{ $subject->id }}" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="bindTeacherModal_{{ $subject->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Assign Class Subject To A Teacher</h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="forms-sample" method="POST" action="{{ route('classes.class.bind_teacher_to_subject', [$class->id, $subject->id]) }}" id="bind_teacher_form_{{$subject->id}}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="teacher">Teacher</label>
                                                                        <select name="teacher" id="teacher" class="form-control" style="width:100%">
                                                                            @foreach($teachers as $teacher)
                                                                                <option @if($subject->teacher) @if($subject->teacher->id == $teacher->id) selected @endif @endif value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if($subject->teacher)
                                                                            <input type="hidden" name="old_teacher" value="{{ $subject->teacher->id }}">
                                                                        @endif
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" form="bind_teacher_form_{{$subject->id}}" class="btn btn-primary">
                                                                    @if($subject->teacher)
                                                                        Change teacher
                                                                    @else
                                                                        Bind teacher
                                                                    @endif
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($subject->teacher)
                                                    <button data-toggle="modal" data-target="#unbindTeacherModal_{{ $subject->id }}" class="btn btn-sm btn-danger"><i class="mdi mdi mdi-link-off mr-2"> unbind teacher</i></button>
                                                    <div class="modal fade" id="unbindTeacherModal_{{ $subject->id }}" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="unbindTeacherModal_{{ $subject->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Unbind {{ $subject->name }} from Teacher ({{ $subject->teacher->name }})</h5>
                                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="forms-sample" method="POST" action="{{ route('classes.class.unbind_teacher_from_subject', [$class->id, $subject->id]) }}" id="unbind_teacher_form_{{$subject->id}}">
                                                                        @csrf
                                                                        <input type="hidden" name="teacher" value="{{ $subject->teacher->id }}">
                                                                        <div>
                                                                            <div class="mb-2">Are you sure you want to unbind teacher ({{ $subject->teacher->name }})</div>
                                                                            <div class="mb-2">from teaching {{ $subject->name }}</div>
                                                                            <div class="mb-2">(class {{ $class->name }}) ?</div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" form="unbind_teacher_form_{{$subject->id}}" class="btn btn-primary">Unbind Teacher</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
{{--                                            <td>--}}
{{--                                                <button data-toggle="modal" data-target="#unbindTeacherModal_{{ $subject->id }}" class="btn btn-sm btn-danger"><i class="mdi mdi mdi-delete-circle mr-2"> detach class</i></button>--}}
{{--                                            </td>--}}
                                            <td>
                                                <a href="{{ route('subjects.subject', $subject->id) }}"><i class="mdi mdi-eye mr-2"></i></a>
                                            </td>
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

        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6"><h4 class="card-title">Finance</h4></div>
                            <div class="col-6">Total Class Debt: {{ $class->students->sum('amount_owing') }}</div>
                        </div>
                        <div class="table-responsive">
                            @if(count($class->students) < 1)
                                No student was found for this class
                            @else
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th class="text-center"> Amount owing </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($class->students as $student)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td> {{ "$student->first_name $student->last_name" }} <br> {{ $student->other_names }} </td>
                                            <td class="text-center"> {{ $student->amount_owing }} </td>
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

        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6"><h4 class="card-title">Promotion</h4></div>
                            @if(count($class->students) > 0)
                                <form class="col-6 form-group" id="promotion_form" method="POST" action="{{ route('classes.promote') }}">
                                    @csrf
                                    <label for="subject">Promotion class</label>
                                    <select required name="promotion_class" class="form-control" style="width:100%">
                                        <option selected>Select Class</option>
                                        @foreach($other_classes as $other_class) as $other_class)
                                        <option value="{{ $other_class->id }}">{{ $other_class->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                        </div>
                        <div class="table-responsive">
                            @if(count($class->students) < 1)
                                No student was found for class
                            @else
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Position </th>
                                        <th>(30%) score</th>
                                        <th>(70%) score</th>
                                        <th> Total score </th>
                                        <th> Total score </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($class->students as $student)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td> {{ "$student->first_name $student->last_name" }} <br> {{ $student->other_names }} </td>
                                            <td> 2nd </td>
                                            <td> 20 </td>
                                            <td> 60 </td>
                                            <td> 80 </td>
                                            <td>
                                                <input form="promotion_form" type="checkbox" name="students[]" value="{{ $student->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        @if(count($class->students) > 0)
                            <div class="mt-2">
                                <button class="btn btn-success" type="submit" form="promotion_form">Promote students</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="col-12 grid-margin stretch-card">--}}
{{--            <div class="col-lg-12 grid-margin stretch-card">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="col-6"><h4 class="card-title">Attendance</h4></div>--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-dark">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th> # </th>--}}
{{--                                    <th> Date </th>--}}
{{--                                    <th> Present student </th>--}}
{{--                                    <th> Absent student</th>--}}
{{--                                    <th> Taken on </th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>1</td>--}}
{{--                                        <td> Mond, 5th January 2022 </td>--}}
{{--                                        <td> 20 </td>--}}
{{--                                        <td> 6 </td>--}}
{{--                                        <td> 11:00 AM </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>1</td>--}}
{{--                                        <td> Mond, 5th January 2022 </td>--}}
{{--                                        <td> 20 </td>--}}
{{--                                        <td> 6 </td>--}}
{{--                                        <td> 11:00 AM </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>1</td>--}}
{{--                                        <td> Mond, 5th January 2022 </td>--}}
{{--                                        <td> 20 </td>--}}
{{--                                        <td> 6 </td>--}}
{{--                                        <td> 11:00 AM </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>1</td>--}}
{{--                                        <td> Mond, 5th January 2022 </td>--}}
{{--                                        <td> 20 </td>--}}
{{--                                        <td> 6 </td>--}}
{{--                                        <td> 11:00 AM </td>--}}
{{--                                    </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div class="mt-2">--}}
{{--                            <a href="#" class="btn btn-success">View all</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editClassModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="editClassModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Class</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="updateClass" id="update_class_form">
                        <div class="form-group">
                            <label for="parent_name">Class Name</label>
                            <input wire:model.defer="class_name" type="text" class="form-control" id="parent_name">
                            @error('class_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="update_class_form" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attach Subject Modal -->
    <div class="modal fade" id="attachSubjectModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="attachSubjectModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attach A Subject To This Class </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="attachSubject" id="attach_subject_form">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select wire:model.defer="subject_to_attach" id="subject" class="form-control" style="width:100%">
                                <option selected>Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_to_attach')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="attach_subject_form" class="btn btn-primary">Attach Subject</button>
                </div>
            </div>
        </div>
    </div>


</div>
