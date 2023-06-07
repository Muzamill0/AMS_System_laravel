@if (session()->has('success'))
    <div class="alert alert-success bg-green-400 alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
    </div>
@elseif (session()->has('error'))
    <div class="alert alert-danger bg-red-600 text-white alert-dismissible fade show" role="alert">
        {{ session()->get('error') }}
    </div>
@endif
