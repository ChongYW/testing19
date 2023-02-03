@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaction history') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h3>Transaction history</h3>
                    <table class="table">
                        <tr>
                            <td>Date and time</td>
                            <td>Amount</td>
                            <td>Description</td>
                            <td>Transaction type</td>
                            <td>Target user ID</td>
                        </tr>
                        @foreach( $relatedData as $data )
                        <tr>
                            <td>{{$data->date_time}}</td>
                            <td>{{$data->amount}}</td>

                            @if (empty($data->description))
                            <td>-</td>
                            @else
                            <td>{{$data->description}}</td>
                            @endif

                            <td>{{$data->transaction_type}}</td>
                            <td>{{$data->to_user_id}}</td>
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
