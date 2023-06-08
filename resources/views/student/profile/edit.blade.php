@extends('student.layout.main')

@section('title', 'Student | EditProfile')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 ">
                            <h3 class="">Add Student</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('student.profile') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')

                    <form action="{{ route('student.profile.edit', $student) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="picture">Edit Profile Picture</label>
                            <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture"
                                name="picture">

                            @error('picture')
                               <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <input type="submit" value="Submit" class="btn btn-primary text-black-50">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
