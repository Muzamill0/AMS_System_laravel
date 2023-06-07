@extends('layout.main')

@section('title', 'Admin | Students')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Students</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('student.create') }}" class="btn btn-outline-primary">Add Student</a>
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
                                        <th>Course</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->user->email }}</td>
                                            <td>{{ $student->course->name }}</td>
                                            <td>
                                                <a href="{{ route('student.profile', $student) }}"
                                                    class="btn btn-primary">Profile</a>
                                                    {{-- <a href="{{ route('admin.students.attendance', $student) }}"
                                                    class="btn btn-primary">Attendance</a> --}}
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