
@section('header') Create Bill @endsection
<div wire:id="fees" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5"><h3>Create New Bill</h3></div>

                    <form class="forms-sample" action="{{ route('bills.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type/Name</label>
                            <input id="type" value="{{ old('type') }}" name="type" type="text" class="form-control">
                            @error('type')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input id="amount" value="{{ old('amount') }}" name="amount" type="text" class="form-control">
                            @error('amount')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <div class="mb-2">For</div>
                            <div>
                                <label class="ml-3">
                                    Student <input wire:model="for" class="custom-radio" type="radio" value="student" name="for">
                                </label>
                                <label class="ml-3">
                                    Class <input wire:model="for" class="custom-radio" type="radio" value="class" name="for">
                                </label>
                            </div>
                        </div>
                        <hr class="bg-danger">
                        @if($for == 'student')
                            <div class="form-group mb-4" id="select_student_form">
                                <div class="form-group">
                                    <label for="student_number">Student Number</label>
                                    <input wire:keyup="fetchStudentInfo" maxlength="8" wire:model="student_number" id="student_number" type="text" class="form-control">
                                    <span class="text-success text-small">{{ $student_name_n_class }}</span>
                                    @error('student_number')<span class="text-danger text-small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @else
                            <div class="form-group mb-4" id="select_class_form">
                            <p>Select Class</p>
                            @foreach($classes as $class)
                                <label class="ml-3">
                                    {{ $class->name }} <input checked class="class_checkbox classes" type="checkbox" value="{{ $class->id }}" name="selected_classes[]">
                                </label>
                            @endforeach
                        </div>
                        @endif
                        <hr class="bg-danger">
                        <div class="row form-group">
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
