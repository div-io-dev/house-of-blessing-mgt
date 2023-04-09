
@section('header') Semester |   @endsection
<div wire:id="semester" class="content-wrapper">













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


