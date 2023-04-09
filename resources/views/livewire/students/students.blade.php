
@section('header') Students @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h3>Students ({{ count($students) }})</h3>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="table-responsive">
                <ul class="navbar-nav w-100">
                    <li class="nav-item w-100">
                        <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                            <input type="text" wire:model="search" name="search" class="form-control" placeholder="Search students">
                        </form>
                    </li>
                </ul>
                @if(count($students) < 1)
                    <div class="mt-5">
                        <h4>Oops!, there are no students in school owing a fees</h4>
                    </div>
                @else

                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th class="text-white"> # </th>
                            <th class="text-white"> Student Name </th>
                            <th class="text-white"> Student ID </th>
                            <th class="text-white"> Class </th>
                            <th class="text-white"> Bus stop </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    {{ "$student->first_name $student->last_name"}}
                                    <p>{{ $student->other_names }}</p>
                                </td>
                                <td> {{ $student->student_number }} </td>
                                <td> {{ $student->class->name }} </td>
                                <td> {{ $student->bus_stop ? $student->bus_stop->town_name : "---" }} </td>
                                <td> <a href="{{ route('students.student', $student->id) }}">
                                        <i class="mdi mdi-eye"></i> view info
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <br>
                <div class="d-flex justify-content-end">
                    <div class="pagination-wrap hstack gap-2">
                        {{$students->links()}}
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

