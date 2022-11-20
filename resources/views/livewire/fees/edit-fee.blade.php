
@section('header') Edit Fee @endsection
<div wire:id="create_fee" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-6"><h4 class="card-title">Edit Fees</h4></div>

                    <form wire:submit.prevent="addItem" id="item_list_form">
                        @csrf
                    </form>

                    <form class="forms-sample" action="{{ route('fees.update', $fee->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control bg-dark" value="{{ $fee->semester->name }}" disabled>
                        </div>

                        <p>Select Classes</p>
                        <div class="form-group mb-4">
                            @foreach($classes as $class)
                                <label class="ml-3">
                                    {{ $class->name }} <input @if(in_array($class->id, $existing_classes_ids)) checked @endif class="class_checkbox classes" type="checkbox" value="{{ $class->id }}" name="selected_classes[]">
                                </label>
                            @endforeach
                        </div>

                        <input type="hidden" name="existing_classes_ids" wire:model="existing_classes_ids_model">

                        <p>Fees Items and Prices</p>

                        <div class="row form-group">
                            <div class="col-6">
                                <input wire:keydown.enter="addItem" form="item_list_form" wire:model="new_item_name" type="text" class="form-control" placeholder="item" id="item">
                                @error('new_item_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6">
                                <input wire:keydown.enter="addItem" form="item_list_form" wire:model="new_item_price" type="text" class="form-control" placeholder="price" id="item_price">
                                @error('new_item_price')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mt-2">
                                <button type="submit" form="item_list_form" class="btn btn-success btn-sm w-25">
                                    <span wire:loading.remove>Add Item</span>
                                    <i wire:loading class="mdi mdi-loading mdi-spin"></i>
                                </button> <br>
                                @error('items')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label>Items</label>
                                <hr style="background: white">
                                @foreach($items as $item)
                                    <div class='row ml-2 mb-2'>
                                        <div class='col-6'>{{ $item['name'] }}</div>
                                        <div class='col-3'>{{ $item['price'] }}</div>
                                        <div class="col-3">
                                            <button wire:click.prevent="removeItem('{{ $item['name'] }}')" class="btn btn-danger btn-sm">remove</button>
                                        </div>
                                    </div>
                                @endforeach
                                <input name="items" type="hidden" wire:model="items_string">
                                <hr style="background: white">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
