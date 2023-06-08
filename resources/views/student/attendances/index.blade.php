@extends('student.layout.main')

@section('title', 'Student | Attendance')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Attendance</h3>
                        </div>
                        <div class="col-6 text-end">

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <p class="text-danger text-center" id="error"></p>
                    @if (count($attendances) > 0)
                        <table class="table table-bordered text-center" id="table">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Reg. No.</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{-- @dd($attendances) --}}
                            <tbody id="tbody">
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->student->reg_no }}</td>
                                        <td>{{ $attendance->student->user->name }}</td>
                                        <td>{{ $attendance->date }}</td>
                                        <td>{{ $attendance->status }}</td>
                                        <td>
                                            <a href="{{ route('student.attendance.create', $attendance->student) }}" class="btn btn-primary">Create Attendance</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger bg-dark text-white" role="alert">No record Found</div>

                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
