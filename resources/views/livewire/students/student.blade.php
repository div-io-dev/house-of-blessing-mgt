
@section('header') Student @endsection
<div wire:id="student" class="content-wrapper">
    <div class="container">
        <div class="main-body">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @if(isset($student->profile_image))
                                    <img src="/{{$student->profile_image }}" alt="Student" style="border-radius: 50%; width: 150px; height: 150px">
                                @endif
                               <div class="mt-3">
                                    <h4>{{"$student->first_name $student->last_name" }}</h4>
                                    <p class="text-secondary mb-1">{{ $student->other_names }}</p>
                                    <p class="text-muted font-size-sm"><a href="{{ route('classes.class', $student->class->id) }}">{{ $student->class->name }}</a></p>
{{--                                    <button class="btn btn-danger">Remove</button>--}}
                                    <button id="openPromote" class="btn btn-success" data-toggle="modal" data-target="#promoteModal">Move to class</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>Bills</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($student->bills() as $bill)
                                <li class="list-group-item bg-dark  align-items-center border-bottom">
                                    <a href="{{ route('bills.bill', $bill->id) }}" target="_blank" class="d-flex justify-content-between flex-wrap">
                                        <h6 class="mb-0">{{ $bill->type }}</h6>
                                        <span class="text-success">{{ $bill->bill_code }}</span>
                                    </a>
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h6 class="mb-0">Amount: {{ $bill->amount }}</h6>
                                        <span class="text-danger">Amount Paid: {{ $bill->amount_paid }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>Subjects</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($student->class->subjects as $subject)
                                <li class="list-group-item bg-dark  align-items-center border-bottom">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <a href="#">
                                            <h6 class="mb-0">{{ $subject->name }}</h6>
                                        </a>
                                        <span class="text-secondary">{{ $subject->code }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>Class Scores</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($class_scores as $class_score)
                                <li class="list-group-item bg-dark  align-items-center border-bottom">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <a href="#">
                                            <h6 class="mb-0">dsa</h6>
                                        </a>
                                        <span class="text-secondary">sas</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>Previous Classes</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($student->classRecords as $class_record)
                                <li class="list-group-item bg-dark  align-items-center border-bottom">
                                    <a target="_blank" href="{{ route('students.student.previous_class', ['student' => $student->id, 'studentClassRecord' => $class_record->id]) }}" class="d-flex justify-content-between flex-wrap">
                                        <h6 class="mb-0">{{ $class_record->class->name }}</h6>
                                        <span class="text-success">{{ count($class_record->semesters) }} semesters</span>
                                    </a>
                                    <div class="row mt-3">
                                        @foreach($class_record->fetched_semesters as $semester)
                                            <h6>Semesters</h6>
                                            <div class="col-12 my-1 border-bottom border-danger">
                                                <a target="_blank" href="{{ route('semesters.semester', $semester->id) }}">
                                                    {{ $semester->name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="col-md-8">

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Student ID</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->student_number }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">First Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->first_name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Last Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->last_name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Other Names</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->other_names }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Last Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->first_name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date Of Birth</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->dob }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Admitted On</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Illuminate\Support\Carbon::parse($student->created_at)->format('Y-m-d') }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Bus Stop</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $bus_stop ? "{$bus_stop->town_name} - (GHS {$bus_stop->price})" : "---" }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button id="openEdit" class="btn btn-info" data-toggle="modal" data-target="#editModal">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Parent's Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->parent->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Parent's Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->parent->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Parent's Town</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->parent->town }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Parent's Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $student->parent->address }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#editParentModal">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                    <div class="row gutters-sm">--}}
{{--                        <div class="col-sm-6 mb-3">--}}
{{--                            <div class="card h-100">--}}
{{--                                <div class="card-body">--}}
{{--                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>--}}
{{--                                    <small>Web Design</small>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <small>Website Markup</small>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <small>One Page</small>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <small>Mobile Template</small>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <small>Backend API</small>--}}
{{--                                    <div class="progress mb-3" style="height: 5px">--}}
{{--                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}



                </div>
            </div>

        </div>
    </div>

    {{--  Modals  --}}

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button type="button" id="hideUpdate" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="update" id="update_form">

                            <div class="form-group">
                                <label for="profile_image">iMAGE</label>
                                <input wire:model.defer="update_student.profile_image" type="file" class="form-control" id="profile_image">
                                @error('updateStudent.profile_image')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input wire:model.defer="update_student.first_name" type="text" class="form-control" id="first_name">
                            @error('updateStudent.first_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="student.last_name">Last Name</label>
                            <input wire:model.defer="update_student.last_name" type="text" class="form-control" id="last_name">
                            @error('updateStudent.last_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="other_name">Other Names</label>
                            <input wire:model.defer="update_student.other_names" type="text" class="form-control" id="other_name">
                            @error('updateStudent.other_names')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="dob">Date Of Birth</label>
                            <input wire:model.defer="update_student.dob" type="date" class="form-control" id="dob">
                            @error('updateStudent.dob')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="dob">Bus Stop</label>
                            <select wire:model="update_student.bus_stop" class="form-control">
                                <option value="null">remove bus stop</option>
                                @foreach(\App\Models\BusStop::all() as $bus_stop)
                                    <option @if($update_student['bus_stop'] == $bus_stop->id) selected @endif value="{{ $bus_stop->id }}">
                                        {{ "{$bus_stop->town_name} - GHS {$bus_stop->price}" }}
                                    </option>
                                @endforeach
                            </select>
                            @error('updateStudent.bus_stop')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="update_form" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Promote Modal -->
    <div wire:key="promote_modal" wire:ignore.self class="modal fade" id="promoteModal" tabindex="-1" role="dialog" aria-labelledby="promoteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Move Student From Class To Another Class</h5>
                    <button type="button" id="hidePromote" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="promote" id="promote_form">
                        <div class="form-group">
                            <label>From</label>
                            <input value="{{ $student->class->name }}" disabled type="text" class="form-control" style="color: black">
                        </div>
                        <div class="form-group">
                            <label for="promote_to">To</label>
                            <select wire:model.defer="promote_to" id="promote_to" class="js-example-basic-single form-control" style="width:100%">
                                <option selected>Select class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('promote_to')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="promote_form" class="btn btn-primary">Move to class</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editParentModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="editParentModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Parent</h5>
                    <button type="button" id="hideUpdate" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="updateParent" id="update_parent_form">
                        <div class="form-group">
                            <label for="parent_name">Full Name</label>
                            <input wire:model.defer="parent.name" type="text" class="form-control" id="parent_name">
                            @error('parent.name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="student.parent_mobile_number">Mobile Number</label>
                            <input wire:model.defer="parent.mobile_number" type="text" class="form-control" id="parent_mobile_number">
                            @error('parent.mobile_number')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="parent_email">Email</label>
                            <input wire:model.defer="parent.email" type="text" class="form-control" id="parent_email">
                            @error('parent.email')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="parent_town">Town</label>
                            <input wire:model.defer="parent.town" type="text" class="form-control" id="parent_town">
                            @error('parent.town')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="parent_address">Address</label>
                            <input wire:model.defer="parent.address" type="text" class="form-control" id="parent_address">
                            @error('parent.address')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="update_parent_form" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>


