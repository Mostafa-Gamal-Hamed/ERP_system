@if (session()->get('success'))
    <div class="alert alert-success text-center">
        <i class="mdi mdi-check"></i> {{ session()->get('success') }}
    </div>
@endif
