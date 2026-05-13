<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
 public function index(){
    $cart = session('cart', []);
    return view('cart.index', compact('cart'));
}

public function addToCart(Request $request){
    $product = Product::find($request->input('product_id'));
    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }

    $cart = session('cart', []);
    $cart[] = [
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => $request->quantity ?? 1
    ];
    session(['cart' => $cart]);

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}

public function removeFromCart($index){
    $cart = session('cart', []);
    if (isset($cart[$index])) {
        unset($cart[$index]);
        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
    return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
}
}
