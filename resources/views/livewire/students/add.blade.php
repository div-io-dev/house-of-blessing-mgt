
@section('header') Add Student @endsection
<div wire:id="admit_student" class="content-wrapper">
    <div class="row">
        <div class="col-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Admit New Student</h4>
                    <p class="card-description"> Student Data </p>
                    <form class="forms-sample" wire:submit.prevent="admit" x-data="{accept: true}">
                        <div class="form-group mb-4">
                            <label for="class_">Class</label>
                            <select wire:model.defer="student.class_" id="class_" class="js-example-basic-single form-control" style="width:100%">
                                <option selected>Select class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('student.class_')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            @if ($profile_image)
                                <img src="{{ $profile_image->temporaryUrl() }}" class="mb-2" style="border-radius: 50%; width: 80px; height: 80px">
                            @endif
                            <label for="profile_image">Profile Image</label>
                            <input wire:model="profile_image" type="file" class="form-control" id="profile_image">
                            @error('profile_image')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input wire:model.defer="student.first_name" type="text" class="form-control" id="first_name">
                            @error('student.first_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="student.last_name">Last Name</label>
                            <input wire:model.defer="student.last_name" type="text" class="form-control" id="last_name">
                            @error('student.last_name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="other_name">Other Names</label>
                            <input wire:model.defer="student.other_names" type="text" class="form-control" id="other_name">
                            @error('student.other_names')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="dob">Date Of Birth</label>
                            <input wire:model.defer="student.dob" type="date" class="form-control" id="dob">
                            @error('student.dob')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="bus_stop">Bus Stop</label>
                            <select wire:model="student.bus_stop" class="form-control">
                                <option value="null" selected>No bus stop</option>
                                @foreach(\App\Models\BusStop::all() as $bus_stop)
                                    <option value="{{ $bus_stop->id }}">
                                        {{ "{$bus_stop->town_name} - GHS {$bus_stop->price}" }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student.bus_stop')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>
                        <p class="card-description mt-4"> Parent Data </p>
                        <div class="form-group row">
                            <label class="col-sm-3 mb-3 col-form-label" for="use_existing_parent">Use Existing Parent</label>
                            <div class="col-sm-9">
                                <input type="checkbox" checked x-model="accept" name="accept" id="accept" value="Yes" wire:model="use_existing_parent" class="">
                            </div>
                        </div>

                        <div x-show="!accept" x-transition>
                            <div class="form-group">
                                <label for="parent_full_name">Full Name</label>
                                <input wire:model.defer="parent.name" type="text" class="form-control" id="parent_full_name">
                                @error('parent.name')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent_mobile_number">Mobile Number</label>
                                <input wire:model.defer="parent.mobile_number" type="text" class="form-control" id="parent_mobile_number">
                                @error('parent.mobile_number')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent_email">Email</label>
                                <input wire:model.defer="parent.email" type="text" class="form-control" id="parent_email">
                                @error('parent.email')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent_town">Town</label>
                                <input wire:model.defer="parent.town" type="text" class="form-control" id="parent_town">
                                @error('parent.town')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent_address">Address</label>
                                <input wire:model.defer="parent.address" type="text" class="form-control" id="parent_address">
                                @error('parent.address')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        <div x-show="accept" x-transition>
                            <div class="form-group">
                                <label for="student_parent">Parent</label>
                                <select wire:model.defer="student.parent_" id="student_parent" class="js-example-basic-single form-control" style="width:100%">
                                    <option selected>Select parent</option>
                                    @foreach($parents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}.({{$parent->mobile_number}})</option>
                                    @endforeach
                                </select>
                                @error('student.parent_')<span class="text-danger text-small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                         @if (!currentSemester())
                            <span><i><small class="text-primary">please add a semester</small></i></span> <br>
                            <button type="submit" disabled class="btn btn-primary mr-2">Admit</button>
                         @else
                            <button type="submit" class="btn btn-primary mr-2">Admit</button>
                         @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
