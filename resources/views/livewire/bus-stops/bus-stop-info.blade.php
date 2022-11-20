
@section('header') Bus Stop Info @endsection
<div wire:id="classes" class="content-wrapper">
    <div class="row">
        <div class="col-12 mb-3 text-center">
            <h3>{{ $bus_stop->town_name }} Bus Stop - GHS {{ $bus_stop->price }} -
                @if(!is_null($bus_stop->kilometers))<span>{{ $bus_stop->kilometers }}Km</span> @endif
            </h3>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="table-responsive"  id="print_container">
                @if(count($students) < 1)
                    <div class="mt-5">
                        <h4>Oops!, there are no students in school owing a fees</h4>
                    </div>
                @else
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Class </th>
                            <th>
                                <button class="btn btn-success btn-sm" onclick="printDiv('print_container')">print</button>
                            </th>
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
                                <td> {{ $student->class->name }} </td>
                                <td> <a href="{{ route('students.student', $student->id) }}">
                                        <i class="mdi mdi-eye"></i> view student's info
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
</div>

