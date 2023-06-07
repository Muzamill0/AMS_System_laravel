@extends('layout.main')

@section('title', 'Admin | Students')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">{{ $course->name }} Students</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('course.attendances', $course) }}" class="btn btn-outline-primary">Attendance</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                        @if (count($students) > 0)
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Reg NO</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->user->email }}</td>
                                            <td>{{ $student->reg_no }}</td>
                                            <td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger" role="alert">
                                No record found!
                            </div>

                        @endif
                </div>
            </div>
        </div>
    </main>
@endsection
