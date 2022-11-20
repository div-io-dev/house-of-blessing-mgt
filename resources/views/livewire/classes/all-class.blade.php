
@section('header') Classes @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="row">
        <div class="row col-12 grid-margin stretch-card">

            @if(count($classes) < 1)
                <div class="mt-5">
                    <h4>Oops!, there are no classes in school DB, please add a new class</h4>
                </div>
            @endif

            @foreach($classes as $class)
                <div class="col-md-4 col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $class->name }}</h4>
                            <div class="media">
                                <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i>
                                <div class="media-body">
                                    <p class="card-text">
                                        {{ count($class->students) }} Students
                                    </p>
                                    <p>
                                        <a href="{{ route('classes.class', $class->id) }}" class="btn btn-primary">Info</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <button class="float" data-toggle="modal" data-target="#addClassModal">
        <i class="mdi mdi-plus float-icon"></i>
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="addClassModal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="addClassModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Class</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="addClass" id="add_class_form">
                        <div class="form-group">
                            <label for="new_class_name">Class Name</label>
                            <input wire:model.defer="new_class_name" type="text" class="form-control" id="new_class_name">
                            @error('new_class_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="add_class_form" class="btn btn-primary">Save Class</button>
                </div>
            </div>
        </div>
    </div>
</div>
