@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pizza Menu</div>

                <div class="card-body">
                    @foreach($pizzas as $pizza)
                        <div class="card-body">
                            <h4>{{ $pizza->name }}</h4>
                            <p>Price: RM{{ $pizza->price }}</p>
                            <button onclick="confirmOrder({{ $pizza->id }}, '{{ $pizza->name }}', {{ $pizza->price }})">Order</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmOrder(id, name, price) {
    if (confirm("The total price is RM" + price + ". Are you sure you would like to order?")) {
        
        // Make a POST request to confirm the order
        fetch('/confirmOrder/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.text())
        .then(data => {
            // Redirect to the payment page
            window.location.href = "/payment/" + id;
        });
    }
}
</script>
@endsection
