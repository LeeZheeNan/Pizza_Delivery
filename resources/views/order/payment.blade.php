@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pizza Order Complete</div>
                <div class="card-body">
                    <h4>Your Order</h4>
                    <p>Pizza: {{ $pizza->name }}</p>
                    <p>Price: RM{{ $pizza->price }}</p>
                    
                    <form method="POST" action="/payment/{{ $pizza->id }}">
                        @csrf

                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                        </div>

                        <div class="form-group">
                            <label for="expiryDate">Expiry Date</label>
                            <input type="text" class="form-control" id="expiryDate" name="expiryDate" required>
                        </div>

                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Pay</button>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
