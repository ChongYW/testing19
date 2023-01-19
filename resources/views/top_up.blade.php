@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Top-up') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ url('topUp') }}">
                        @csrf
                        @method('PUT')

                        <label for="transaction_type">Please select your target wallet and top-up amount :</label>

                        <br>

                        <select id="target_wallet" name="target_wallet">
                            <option value="capital">Capital wallet</option>
                            <option value="bonus">Bonus wallet</option>
                        </select>

                        <br>
                        <br>

                        <input id="amount" type="number" step="any" class="form-control" name="amount" required autofocus placeholder="Top-up amount">

                        <br>

                        <button type="submit" class="btn btn-primary" >Top-up</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
