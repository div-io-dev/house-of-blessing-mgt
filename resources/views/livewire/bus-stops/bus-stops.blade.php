
@section('header') Bus Stops @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h3>Bus Stops ({{ count($bus_stops) }})</h3>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="table-responsive" id="print_container">
                @if(count($bus_stops) < 1)
                    <div class="mt-5">
                        <h4>Oops!, there are no bus stops in the Database</h4>
                    </div>
                @else
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Town </th>
                            <th> Price </th>
                            <th> Kilometers </th>
                            <th> <span class="underline">No</span> of students </th>
                            <th> Revenue </th>
                            <th>
                                <button class="btn btn-success btn-sm" onclick="printDiv('print_container')">print</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bus_stops as $bus_stop)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $bus_stop->town_name }}</td>
                                <td> GHS {{ $bus_stop->price }} </td>
                                <td> {{ $bus_stop->kilometers }} Km </td>
                                <td> {{ count($bus_stop->students) }} </td>
                                <td> GHS {{ $bus_stop->total_revenue }} </td>
                                <td> <a href="{{ route('bus_stop.info', $bus_stop->id) }}">
                                        <i class="mdi mdi-eye"></i> view info
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
    <button class="float" data-toggle="modal" data-target="#add">
        <i class="mdi mdi-plus float-icon"></i>
    </button>

    <!-- Add Modal -->
    <div class="modal fade" id="add" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="addSemesterModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Buss Stop</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="addBusStop" id="add_bus_stop_form">
                        <div class="form-group">
                            <label for="town_name"> Town Name <sup class="text-danger">*</sup></label>
                            <input required  wire:model.defer="new_bus_stop.town_name" type="text" class="form-control" id="town_name">
                            @error('new_bus_stop.town_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price <sup class="text-danger">*</sup></label>
                            <input wire:model.defer="new_bus_stop.price" required type="text" class="form-control" id="price">
                            @error('new_bus_stop.price')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="kilometers">Kilometers</label>
                            <input wire:model.defer="new_bus_stop.kilometers" type="text" class="form-control" id="kilometers">
                            @error('new_bus_stop.kilometers')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="add_bus_stop_form" class="btn btn-primary">Save Semester</button>
                </div>
            </div>
        </div>
    </div>

</div>

