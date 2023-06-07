@extends('layout.main')

@section('title', 'Admin | Add Students')

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
                            <a href="{{ route('students') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')

                    <form action="{{ route('student.edit', $student) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="user_type">User Type</label>
                                <select name="user_type" id="user_type" class="form-control @error('user_type') is-invalid @enderror">
                                    <option value="" selected hidden disabled>Select a user_type</option>
                                    @foreach ($users_type as $user_type)
                                        <option value="{{ $user_type }}
                                        "@if (old('user_type')) {{ old('user_type') == $student->user->user_type ? 'selected' : '' }} @else {{ $student->user->user_type == $user_type ? 'selected' : '' }} @endif>
                                            {{ $user_type }}</option>
                                    @endforeach
                                </select>

                                @error('user_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                    </div>

                                <div class="col-md-6">
                                     <label for="course">Course</label>
                                    <select name="course" id="course" class="form-control @error('course') is-invalid @enderror">
                                        <option value="" selected hidden disabled>Select a course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"
                                                @if (old('course')) {{ old('course') == $course->id ? 'selected' : '' }} @else {{ $student->course_id == $course->id ? 'selected' : '' }} @endif>
                                                {{ $course->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('course')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') ? old('name') : $student->user->name }}"
                                        placeholder="Enter the name">

                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') ? old('email') :  $student->user->email}}"
                                        placeholder="Enter the email">

                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="password">password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter the password">

                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone')? old('phone') :  $student->user->contact_no }}"
                                        placeholder="Enter the phone">

                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="dob">DoB</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        id="dob" name="dob" value="{{ old('dob')? old('dob') :  $student->user->dob }}">

                                    @error('dob')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="picture">Profile Picture</label>
                                    <input type="file" class="form-control @error('picture') is-invalid @enderror"
                                        id="picture" name="picture">

                                    @error('picture')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="3"
                                placeholder="Enter the address">{{ old('address')? old('address') :  $student->user->address }}</textarea>
                        </div>

                        <div>
                            <input type="submit" value="Submit" class="btn btn-primary text-black-50">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
