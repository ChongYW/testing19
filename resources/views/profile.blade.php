@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @elseif (session('error_warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('error_warning') }}
                    </div>
                    @endif

                    <div>
                        <h4>ID</h4>
                        {{ $user -> id }}
                    </div>

                    <hr>

                    <div>
                        <h4>Name</h4>
                        {{ $user -> name }}
                    </div>

                    <hr>

                    <div>
                        <h4>Email</h4>
                        {{ $user -> email }}
                    </div>

                    <hr>

                    @if (empty(Auth::user() -> dob))

                    <div>
                        <h4>Day of birth</h4>
                        Not yet set...
                    </div>

                    @else

                    <div>
                        <h4>Day of birth</h4>
                        {{ $user -> dob }}
                    </div>

                    @endif

                    <hr>

                    <div>
                        <h4>Register date</h4>
                        {{ $user -> register_date }}
                    </div>

                    <hr>

                    @if (empty(Auth::user() -> referral_id))

                    <div>
                        <h4>Referral ID</h4>
                        Not yet set...
                    </div>

                    @else

                    <div>
                        <h4>Referral ID</h4>
                        {{ $user -> referral_id }}
                    </div>

                    @endif

                    <hr>

                    <div>
                        <a class="btn btn-primary" href="{{ url('edit_profile') }}">Edit</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
