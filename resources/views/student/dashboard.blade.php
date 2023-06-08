@extends('student.layout.main')

{{-- @yield('title', 'Student | Dashboard') --}}

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

        @include('partials.alerts')

    </div>
</main>

@endsection
