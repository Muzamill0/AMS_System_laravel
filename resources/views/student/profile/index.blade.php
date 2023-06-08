@extends('student.layout.main')

@section('title', 'Student | Profile')

@section('content')

    <main>
        <div class="container-fluid px-4">
            <div class="card mt-4" ;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="">Student Profile </h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('partials.alerts')
                    <section>
                        <div class="container py-5">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card mb-4" style="background: rgb(212, 210, 210)">
                                            <div class="card-body text-center">
                                                <img src="{{ asset('student_uploads/' . $student->user->image) }}"
                                                    alt="avatar" class="rounded-circle img-fluid mx-auto"
                                                    style="width: 150px; height: 150px">
                                                    <div class="mt-3 row">
                                                        <div class="col-sm-6">
                                                            <p class="mb-0">Name</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p class="text-muted mb-0">{{ $student->user->name }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p class="mb-0">Reg No</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p class="text-muted mb-0">{{ $student->reg_no }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p class="mb-0">Course</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p class="text-muted mb-0">{{ $student->course->name }}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                {{-- <h5 class="my-3">{{ $student->user->name }}</h5>
                                                <h5 class="my-3">{{ $student->reg_no }}</h5>
                                                <h5 class="my-3">{{ $student->course->name }}</h5> --}}

                                                <div class="d-flex justify-content-center mb-2">
                                                    <a href="{{ route('student.profile.edit', $student) }}"
                                                        class="btn btn-primary">Edit Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4" style="background: rgb(212, 210, 210)">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Full Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->user->name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->user->email }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Date of birth</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"> {{ $student->user->dob == '' ? 'N/A' : $student->user->dob }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Phone</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"> {{ $student->user->contact_no == '' ? 'N/A' : $student->user->contact_no }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Address</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $student->user->address == '' ? 'N/A' : $student->user->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </section>



                </div>
            </div>
        </div>
    </main>









@endsection
