@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                        <div>
                            <h3>Capital wallet</h3>
                            <br>
                            <p>Type : </p>
                            <p>{{ $capitalWallet -> type }}</p>
                            <br>
                            <p>Amount : </p>
                            <p>{{ $capitalWallet -> amount }}</p>
                        </div>

                        <hr>

                        <div>
                            <h3>Bonus wallet</h3>
                            <br>
                            <p>Type : </p>
                            <p>{{ $bonusWallet -> type }}</p>
                            <br>
                            <p>Amount : </p>
                            <p>{{ $bonusWallet -> amount }}</p>
                        </div>

                        <hr>

                    <button href="#" class="btn btn-success">Top-up</button>
                    <button href="#" class="btn btn-primary">Transfer</button>
                    <button href="#" class="btn btn-warning">Withdraw</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
