
@section('header') New Fee @endsection
<div wire:id="create_fee" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-6"><h4 class="card-title">Create A Fees</h4></div>

                    <form class="forms-sample" wire:submit.prevent="store">
                        <div class="form-group mb-4">
                            <label for="semester">Semester</label>
                            <select wire:model.defer="semester" id="semester" class="js-example-basic-single form-control" style="width:100%">
                                <option selected>Select Semester</option>
                                @foreach($semesters as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                @endforeach
                            </select>
                            @error('semester')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="semester">Academic Year</label>
                            <select wire:model.defer="academic_year" id="academic_year" class="js-example-basic-single form-control" style="width:100%">
                                <option selected>Select Academic year</option>
                                @foreach($academic_years as $academic_year)
                                    <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                                @endforeach
                            </select>
                            @error('academic_year')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <p>Fees data and charges</p>
                        <div class="row form-group">
                            <input type="hidden" name="items[]" id="items">
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="item" id="item">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="price" id="item_price">
                            </div>
                            @error('items')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            <div class="col-6 mt-2">
                                <button type="button" id="addItemBtn" class="btn btn-success btn-sm">Add Item</button>
                            </div>
                            <div class="col-12 mt-3">
                                <label>Items</label>
                                <hr style="background: white">
                                <div id="item_list_container">
                                    <div class='row mb-2'><div class='col-6'>"+loop_item.item+"</div><div class='col-3'>"+loop_item.price+"</div><div class="col-3"><button onclick="removeItem()" class="btn btn-danger btn-sm">remove</button></div></div>
                                </div>
                                <hr style="background: white">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mr-2">Create Fee</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
