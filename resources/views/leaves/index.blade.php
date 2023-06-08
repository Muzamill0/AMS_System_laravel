@extends('layout.main')

@section('title', 'Admin | Students')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Leave Requests</h3>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    @if (count($leaves) > 0)
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $leave)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $leave->student->user->name }}</td>
                                        <td>{{ $leave->student->reg_no }}</td>
                                        <td>{{ $leave->attendance->date }}</td>
                                        <td>
                                            <form action="{{ route('leave.action', $leave) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-control-label"
                                                            for="{{ $leave->student->id }}_accept">Accept</label>
                                                        <input class="form-control-input" type="radio"
                                                            name="{{ $leave->student->id }}" id="{{ $leave->student->id }}_accept"
                                                            value="Accept" checked>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <label class="form-control-label"
                                                            for="{{ $leave->student->id }}_reject">Reject</label>
                                                        <input class="form-control-input" type="radio"
                                                            name="{{ $leave->student->id }}" id="{{ $leave->student->id }}_reject"
                                                            value="Reject">
                                                    </div>

                                                    <input type="submit" value="Submit" class="btn btn-primary ml-3">
                                                </div>
                                            </form>
                                            {{-- <a href="{{ route('leave.accept', $leave) }}"
                                                    class="btn btn-primary">Accept</a>
                                                    <a href="{{ route('leave.reject', $leave) }}"
                                                    class="btn btn-primary">Reject</a> --}}
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
