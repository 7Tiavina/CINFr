@extends('layouts.backend')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h1>{{ __('Dashboard') }}</h1>
        <p>{{ __('Welcome to the admin dashboard!') }}</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('.alert-success');
            if (alert) {
                setTimeout(() => {
                    $(alert).alert('close');
                }, 5000); // Close after 5 seconds
            }
        });
    </script>
@endsection
