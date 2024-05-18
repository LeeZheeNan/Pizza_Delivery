<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{
/*    public function index()
    {

        return view('home.index');
    }*/

    public function pizza()
    {
        $pizzas = Pizza::all();

        return view('order.pizza', ['pizzas' => $pizzas,]);
    }

    public function show($id)
    {
        
        // Check the order details in the session
        $order = session('order');
        if (!$order || $order['pizza_id'] != $id || !$order['confirmed']) {
            // If order was not confirmed, redirect the user

            // Clear any existing order in the session
            session()->forget('order');

            return redirect('/pizza');
        }

        $pizza = Pizza::findOrFail($id);
        
        return view('order.payment', ['pizza' => $pizza]);
        }

    public function confirmOrder($id)
    {
        // Clear any existing order in the session
        session()->forget('order');

        // Confirm the new order
        $order = ['pizza_id' => $id, 'confirmed' => true];
        session(['order' => $order]);

        return response('Order confirmed');
    }
    
    public function payment(Request $request, $id)
    {

        // Check the order details in the session
        $order = session('order');
        if (!$order || $order['pizza_id'] != $id || !$order['confirmed']) {
            // If order was not confirmed, redirect the user
            return redirect('/pizza');
        }

        // Validate the payment form data
        /*$request->validate([
            'cardNumber' => 'required|numeric',
            'expiryDate' => 'required|date',
            'cvv' => 'required|numeric|min:100|max:999',
        ]);*/

        // Process the payment 
        $paymentSuccess = true;  // or false, depending on the payment result  

        // Store the payment status in the session
        session(['paymentSuccess' => $paymentSuccess]);

        return redirect()->route('payment.result', ['id' => $id, 'success' => $paymentSuccess]);
    }

    public function paymentResult($id)
    {
        
    // Check the payment status in the session
    $paymentSuccess = session('paymentSuccess');
    if (!$paymentSuccess) {
        // If payment was not made, redirect the user
        return redirect('/pizza');
    }
 
    $pizza = Pizza::findOrFail($id);

    // Clear any existing payment result in the session
    session()->forget('paymentSuccess');
    // Clear any existing order in the session
    session()->forget('order');

    return view('payment.result', ['pizza' => $pizza, 'success' => $paymentSuccess]);
    }
}