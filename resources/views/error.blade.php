@if (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif