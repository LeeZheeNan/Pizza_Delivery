@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Result</div>

                <div class="card-body">
                    @if ($success)
                        <h4>Payment Successful!</h4>
                        <p>Thank you for your pizza order. It will arrive piping hot within 30 to 45 minutes!</p>
                    @else
                        <h4>Payment Failed!</h4>
                    @endif

                    <p>Your Order:</p>
                    <p>Pizza: {{ $pizza->name }}</p>
                    <p>Price: RM{{ $pizza->price }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
