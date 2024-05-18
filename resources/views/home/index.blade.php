@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Welcome to Pizza Delivery!</h1>
        <p class="lead">Only authenticated users can access this section.</p>
        <div class="card-body">
            <h4></h4> 
        </div>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection
