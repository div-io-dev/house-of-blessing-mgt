
@section('header') Semester | {{ $semester->name }} @endsection
<div wire:id="semester" class="content-wrapper">
    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h5>{{ $semester->name }}</h5>
            <button class="btn btn-success btn-sm ml-3" data-toggle="modal" data-target="#updateSemesterModal">Update</button>
            @if(!$semester->is_ended)
                <button class="btn btn-danger btn-sm ml-3" data-toggle="modal" data-target="#endSemesterModal">End Semester</button>
            @endif
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">Start Date</div>
                            <div class="col-6 text-success">{{ $semester->formatted_created_at }}</div>
                        </div>
                        <hr style="background:#505050;">
                        <div class="row">
                            <div class="col-6">End Date</div>
                            <div class="col-6 text-danger">
                                {{ $semester->end_date ?? 'Not set' }}
                                @if(!$semester->end_date)
                                    <button class="btn btn-success btn-sm ml-3" data-toggle="modal" data-target="#updateSemesterModal">Set</button>
                                @else
                                    <button class="btn btn-primary btn-sm ml-3" data-toggle="modal" data-target="#updateSemesterModal">Change</button>
                                @endif

                            </div>
                        </div>
                        <hr style="background:#505050;">
                        <div class="row">
                            <div class="col-6">Description</div>
                            <div class="col-6">{{ $semester->description }}</div>
                        </div>
                        <hr style="background:#505050;">
                        <div class="row">
                            <div class="col-6">Created By</div>
                            <div class="col-6">{{ $semester->added_by_name }}</div>
                        </div>
                        <hr style="background:#505050;">
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="updateSemesterModal" tabindex="-1" role="dialog" aria-labelledby="updateSemesterModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Semester</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" wire:submit.prevent="update" id="update_semester_form">
                            <div class="form-group">
                                <label for="name">Semester Name <sup class="text-danger">*</sup></label>
                                <input required wire:model.defer="name" type="text" class="form-control" id="name">
                                @error('name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input wire:model.defer="description" type="text" class="form-control" id="description">
                                @error('description')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date <sup class="text-danger">*</sup></label>
                                <input required wire:model.defer="start_date" type="date" class="form-control" id="start_date">
                                @error('start_date')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input wire:model.defer="end_date" type="date" class="form-control" id="end_date">
                                @error('end_date')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="update_semester_form" class="btn btn-primary">Save Semester</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="endSemesterModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="endSemesterModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure you want to end this semester ?</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button wire:click="markAsEnded" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
</div>

    </div>




    <div>
        <div class="col-12 mb-3">
            <h5>Fees</h5>
        </div>

        <div class="row grid-margin stretch-card">
            @if(count($fees) < 1)
                <div class="mt-5">
                    <h4>Oops!, there are no fees</h4>
                </div>
            @endif

            @foreach($fees as $fee)
                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $fee->name }}</h4>
                            <div class="media">
                                <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i>
                                <div class="media-body">
                                    <p class="card-text">
                                        Total Amount : {{ $fee->total_amount }}
                                    </p>
                                    <p class="card-text">
                                        @foreach($fee->classes as $class)
                                            <span>{{ $class->name }} | </span>
                                        @endforeach
                                    </p>
                                    <div class="row text-sm mb-3">
                                        <div class="col-12" style="height: 25px; padding-top: 0px;"><hr class="bg-danger"></div>
                                        @foreach($fee->items as $item)
                                            <div class="col-6">{{ $item['name'] }}</div>
                                            <div class="col-6">{{ $item['price'] }}</div>
                                            <div class="col-12" style="height: 25px; padding-top: 0px;"><hr class="bg-danger"></div>
                                        @endforeach
                                    </div>
                                    <div>
                                        <a href="{{ route('fees.fee', $fee->id) }}" class="btn btn-primary">Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="modal fade" id="updateSemesterModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="updateSemesterModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Semester</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" wire:submit.prevent="update" id="update_semester_form">
                            <div class="form-group">
                                <label for="name">Semester Name <sup class="text-danger">*</sup></label>
                                <input required wire:model.defer="name" type="text" class="form-control" id="name">
                                @error('name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input wire:model.defer="description" type="text" class="form-control" id="description">
                                @error('description')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date <sup class="text-danger">*</sup></label>
                                <input required wire:model.defer="start_date" type="date" class="form-control" id="start_date">
                                @error('start_date')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input wire:model.defer="end_date" type="date" class="form-control" id="end_date">
                                @error('end_date')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="update_semester_form" class="btn btn-primary">Save Semester</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

