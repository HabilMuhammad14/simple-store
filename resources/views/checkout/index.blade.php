@extends('layouts.app')
@section('content')
<h4>Checkout</h4>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cart as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['name'] }}</td>
            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-end fw-bold">Total:</td>
            <td class="fw-bold">
                Rp {{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 0, ',', '.') }}
            </td>
        </tr>
    </tfoot>
</table>

<form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <button class="btn btn-primary">Konfirmasi Order</button>
    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Kembali ke Keranjang</a>
</form>
@endsection
