@extends('layout.main')

@section('title', 'Admin | Edit Course')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Edit Course</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('courses') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                        @include('partials.alerts')

                        <form action="{{ route('course.edit', $course) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ? old('name') : $course->name }}" placeholder="Enter the course name">

                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </main>
@endsection
