@extends('layout.main')

@section('title', 'Teacher | Attendance')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="">Edit Attendance</h3>
                        </div>
                        <div class="col-6 text-end" >
                            <a href="{{ route('course.attendances', $course) }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="{{ route('course.attendance.edit', $attendance) }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                            @error('date')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Reg. No.</th>
                                    <th>Name</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->reg_no }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="form-check form-check-inline text-end">
                                                <label class="form-control-label" for="{{ $student->id }}_present">Present</label>
                                                <input class="form-control-input" type="radio" name="{{ $student->id }}"
                                                    id="{{ $student->id }}_present" value="present" checked>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <label class="form-control-label" for="{{ $student->id }}_absent">Absent</label>
                                                <input class="form-control-input"  type="radio" name="{{ $student->id }}"
                                                    id="{{ $student->id }}_absent" value="absent">
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <input type="submit" value="Submit" class="btn btn-primary mt-3">
                    </form
                </div>
            </div>
        </div>
    </main>
@endsection
