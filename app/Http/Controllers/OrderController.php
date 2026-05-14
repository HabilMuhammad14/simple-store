<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('orderItems.product')->where('user_id', auth()->id())->latest()->get();
        return view('orders.index', compact('orders'));
    }
}
