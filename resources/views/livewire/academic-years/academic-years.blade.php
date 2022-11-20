
@section('header') Academic Years @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">

            @if(count($academicYears) < 1)
                <div class="mt-5">
                    <h4>Oops!, there are no academic year in school DB, please add a new academic year</h4>
                </div>
            @endif

            @foreach($academicYears as $academicYear)
                <div class="col-md-4 col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $academicYear->name }}</h4>
                            <div class="media">
                                <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i>
                                <div class="media-body">
                                    <p class="card-text">
                                        Start Year: {{ $academicYear->start_date }}
                                    </p>
                                    <p class="card-text">
                                        End Year: {{ $academicYear->end_date }}
                                    </p>
                                    <p>
                                        <a href="{{ route('academic-years.academic-year', $academicYear->id) }}" class="btn btn-primary">Info</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <button class="float" data-toggle="modal" data-target="#addAcademicYearModal">
        <i class="mdi mdi-plus float-icon"></i>
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addAcademicYearModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="addAcademicYearModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Semester</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="addAcademicYear" id="add_academic_year_form">
{{--                        <div class="form-group">--}}
{{--                            <label for="new_ay_name">Name</label>--}}
{{--                            <input wire:model.defer="new_ay_name" type="text" class="form-control" id="new_ay_name">--}}
{{--                            @error('new_ay_name')<span class="text-danger text-small">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label for="new_ay_start_date">Start Date</label>
                            <input wire:model.defer="new_ay_start_date" type="date" class="form-control" id="new_ay_start_date">
                            @error('new_ay_start_date')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_ay_start_date">End Date</label>
                            <input wire:model.defer="new_ay_end_date" type="date" class="form-control" id="new_ay_end_date">
                            @error('new_ay_end_date')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="add_academic_year_form" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

