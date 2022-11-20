
@section('header') Semesters @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h3>Semesters</h3>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="table-responsive">
                @if(count($semesters) < 1)
                    <div class="mt-5">
                        <h4>Oops!, there are no semesters in school DB, please add a new semester</h4>
                    </div>
                @else
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Description </th>
                            <th> Start Date </th>
                            <th> End Date </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($semesters as $semester)
                            <tr>
                                <td>1</td>
                                <td> {{ $semester->name }} </td>
                                <td> {{ $semester->description ?? "---------" }} </td>
                                <td> {{ $semester->start_date }} </td>
                                <td> {{ $semester->end_date ?? "Not set"}} </td>
                                <td> <a href="{{ route('semesters.semester', $semester->id) }}">
                                        <i class="mdi mdi-eye"></i> view more info
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

    <button class="float" data-toggle="modal" data-target="#addSemesterModal">
        <i class="mdi mdi-plus float-icon"></i>
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addSemesterModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="addSemesterModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Semester</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="addSemester" id="add_semester_form">
                        <div class="form-group">
                            <label for="new_semester_name">Semester Name <sup class="text-danger">*</sup></label>
                            <input required placeholder="2021/2022 Academic Year - First Semester" wire:model.defer="new_semester_name" type="text" class="form-control" id="new_semester_name">
                            @error('new_semester_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_semester_description">Description</label>
                            <input wire:model.defer="new_semester_description" type="text" class="form-control" id="new_semester_description">
                            @error('new_semester_description')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_semester_start_date">Starting On <sup class="text-danger">*</sup></label>
                            <input required wire:model.defer="new_semester_start_date" type="date" class="form-control" id="new_semester_start_date">
                            @error('new_semester_start_date')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_semester_end_date">Ending On</label>
                            <input wire:model.defer="new_semester_end_date" type="date" class="form-control" id="new_semester_end_date">
                            @error('new_semester_end_date')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="add_semester_form" class="btn btn-primary">Save Semester</button>
                </div>
            </div>
        </div>
    </div>
</div>

