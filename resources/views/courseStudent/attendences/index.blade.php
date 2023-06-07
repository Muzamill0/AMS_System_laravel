@extends('layout.main')

@section('title', 'Teacher | Attendance')

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
                            <a href="{{ route('course.students', $course) }}" class="btn btn-outline-primary">Back</a>
                            <a href="{{ route('course.attendance.create', $course) }}"
                                class="btn btn-outline-primary">Create Attendance</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="" id="form">
                        @csrf
                        <div class="mb-3 row">
                            <label for="date" class="col-sm-1 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date">
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary p-2" id="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                    <p class="text-danger text-center" id="error"></p>

                    <table class="table table-bordered text-center d-none" id="table">
                        <thead>
                            <tr>
                                <th>Reg. No.</th>
                                <th>Name</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        const formElement = document.querySelector('#form');
        const tbodyElement = document.querySelector('#tbody');
        const dateElement = document.querySelector('#date');
        const tableElement = document.querySelector('#table');

        formElement.addEventListener('submit', function(e) {
            e.preventDefault();

            const dateElementValue = dateElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            if (dateElementValue == "" || dateElementValue === undefined) {
                alert("Please select the date");
            } else {
                const data = {
                    date: dateElementValue,
                    course_id: {{ $course->id }},
                    _token: token,
                }

                    fetch('{{ route('fetch.attendances') }}', {
                        method: 'POST',
                        body: JSON.stringify(data),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(function(response) {
                        return response.json();
                    }).then(function(result) {
                        console.log(result);
                        if (result != "notFound") {
                            error.innerHTML = '';
                            tableElement.classList.remove('d-none');
                            tbodyElement.innerHTML = result;
                        } else{
                            let element = '<div class="alert alert-danger bg-dark text-white" role="alert">No record Found</div>';
                            tableElement.classList.add('d-none');
                            error.innerHTML = element;
                        }
                    });
            }
        });
    </script>
@endsection
