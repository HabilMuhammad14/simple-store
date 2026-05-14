<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index(){
        $cart = session('cart', []);
        if(empty($cart)){
            return redirect()->route('cart.index')->with('error', "Keranjang Kosong");
        }
        return view('checkout.index', compact('cart'));
    }
    public function store(Request $request){
        $cart = session('cart', []);

        if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => $totalPrice,
        'status' => 'pending',
        ]);

        foreach ($cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat!');
    }
}
