@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transfer') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ url('transfer') }}">
                        @csrf
                        @method('PUT')

                        <label for="transaction_type">Please select your target wallet, input target transfer ID and transfer amount :</label>

                        <br>

                        <select id="target_wallet" name="target_wallet">
                            <option value="capital">Capital wallet</option>
                            <option value="bonus">Bonus wallet</option>
                        </select>

                        <br>
                        <br>

                        <input id="to_wallet_id" type="number" class="form-control" name="to_wallet_id" required autofocus placeholder="Target wallet ID">

                        <br>

                        <input id="amount" type="number" step="any" class="form-control" name="amount" required autofocus placeholder="Transfer amount">

                        <br>

                        <input id="description" type="text" class="form-control" name="description" autofocus placeholder="Description(Optional)">

                        <br>

                        <button type="submit" class="btn btn-primary" >Transfer</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
