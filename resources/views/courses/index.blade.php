@extends('layout.main')

@section('title', 'Admin | Courses')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Courses</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('course.create') }}" class="btn btn-outline-primary">Add Course</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                        @if (count($courses) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>
                                                <a href="{{ route('course.edit', $course) }}"
                                                    class="btn btn-primary">Edit</a>
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
