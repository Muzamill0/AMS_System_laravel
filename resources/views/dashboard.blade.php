@extends('layout.main')

@yield('title', 'Student | Dashboard')

@section('content')

<h3 class=" mb-3 text-primary"><strong>Welcome</strong> Attendence Management Portal</h3>

@if(count($leaves) > 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Leave request !</strong> Found
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

@endsection
