
@section('header') Teacher @endsection
<div wire:id="student" class="content-wrapper">
    <div class="container">
        <div class="main-body">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ $teacher->profile_image_url }}" alt="Teacher" style="height: 150px; width: 150px; border-radius: 50%">
                                <div class="mt-3">
                                    <h4>{{"$teacher->name" }}</h4>
                                    <button class="btn btn-danger">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $teacher->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $teacher->username }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile Number</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $teacher->mobile_number }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $teacher->email ?? "Not set" }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Salary</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $teacher->salary }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Certificate</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $teacher->certificate }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Certificate Image</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img src="{{ $teacher->certificate_image_url }}" style="height: 150px; width: 150px;">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Added On</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Illuminate\Support\Carbon::parse($teacher->created_at)->format('Y-m-d') }}
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

                    <div class="row gutters-sm">

                        @foreach($classes as $index => $class)
                            <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">{{ $class->name }}</i></h6>
                                    @foreach(getSubjectsOfClassAndTeacher($class, $teacher) as $subject)
                                        <small>{{ $subject->name }}</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>



                </div>
            </div>

        </div>
    </div>

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
                            <label for="name">Name</label>
                            <input wire:model.defer="update_teacher.name" type="text" class="form-control" id="name">
                            @error('update_teacher.name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="student.username">Username</label>
                            <input wire:model.defer="update_teacher.username" type="text" class="form-control" id="username">
                            @error('update_teacher.username')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input wire:model.defer="update_teacher.mobile_number" type="text" class="form-control" id="mobile_number">
                            @error('update_teacher.mobile_number')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input wire:model.defer="update_teacher.email" type="text" class="form-control" id="email">
                            @error('update_teacher.email')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input wire:model.defer="update_teacher.salary" type="text" class="form-control" id="salary">
                            @error('update_teacher.salary')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="certificate">Certificate</label>
                            <input wire:model.defer="update_teacher.certificate" type="text" class="form-control" id="certificate">
                            @error('update_teacher.certificate')<span class="text-danger text-small">{{ $message }}</span> @enderror
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

</div>


