
@section('header') Teachers @endsection
<div wire:id="teachers" class="content-wrapper">




    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4"><h4 class="card-title">Teachers ({{ count($teachers) }})</h4></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> <span class="underline">No</span> of Teaching Subjects </th>
                                <th> <span class="underline">No</span> of Teaching Classes </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td> {{ $teacher->name }} </td>
                                    <td> 15 </td>
                                    <td> {{ count($teacher->classes) }} </td>
                                    <td>
                                        <a href="{{ route('teachers.teacher', $teacher->id) }}"><i class="mdi mdi-eye mr-2"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <button class="float" data-toggle="modal" data-target="#addTeacherModal">
        <i class="mdi mdi-plus float-icon"></i>
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addTeacherModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="addTeacherModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Teacher</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="addTeacher" id="add_teacher_form">
                        <div class="form-group">
                            <label for="new_teacher_name">Name</label>
                            <input wire:model.defer="new_teacher.name" type="text" class="form-control" id="new_teacher_name">
                            @error('new_teacher.name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_teacher_username">Username</label>
                            <input wire:model.defer="new_teacher.username" type="text" class="form-control" id="new_teacher_username">
                            @error('new_teacher.username')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_teacher_mobile_number">Mobile Number</label>
                            <input wire:model.defer="new_teacher.mobile_number" type="text" class="form-control" id="new_teacher_mobile_number">
                            @error('new_teacher.mobile_number')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_teacher_salary">Salary</label>
                            <input wire:model.defer="new_teacher.salary" type="text" class="form-control" id="new_teacher_salary">
                            @error('new_teacher.salary')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_teacher_email">Email</label>
                            <input wire:model.defer="new_teacher.email" type="text" class="form-control" id="new_teacher_email">
                            @error('new_teacher.email')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_teacher_certificate">Certificate</label>
                            <input wire:model.defer="new_teacher.certificate" type="text" class="form-control" id="new_teacher_certificate">
                            @error('new_teacher.certificate')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_teacher_certificate_file">Certificate File</label>
                            <input wire:model="new_teacher_certificate_file" type="file" class="form-control" id="new_teacher_certificate_file">
                            @error('new_teacher_certificate_file')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            @if ($new_teacher_profile_image_file)
                                <img src="{{ $new_teacher_profile_image_file->temporaryUrl() }}" class="mb-2" style="border-radius: 50%; width: 80px; height: 80px">
                            @endif
                            <label for="new_teacher_profile_image_file">Profile Image</label>
                            <input wire:model="new_teacher_profile_image_file" type="file" class="form-control" id="new_teacher_profile_image_file">
                            @error('new_teacher_profile_image_file')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="add_teacher_form" class="btn btn-primary">Add Teacher</button>
                </div>
            </div>
        </div>
    </div>

</div>
