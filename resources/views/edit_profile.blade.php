@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ url('update_profile') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user -> name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user -> email }}"  readonly>

                                <div class="col-md-8">
                                    <a class="btn btn-primary col-md-6" href="#">Change email</a>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <a class="btn btn-primary col-md-4" href="#">Change password</a>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('Day of birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ $user -> dob }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="referral_id" class="col-md-4 col-form-label text-md-end">{{ __('Referral ID(Optional)') }}</label>

                            <div class="col-md-6">
                                <input id="referral_id" type="number" class="form-control" name="referral_id" value="{{ $user -> referral_id }}">
                            </div>

                            @if (\Session::has('referral_id_error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{!! \Session::get('referral_id_error') !!}</li>
                                </ul>
                            </div>
                            @endif

                        </div>

                        <div class="row mb-0 p-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
