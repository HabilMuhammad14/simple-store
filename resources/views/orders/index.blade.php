@extends('layouts.app')
@section('content')
<h4>Riwayat Order</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($orders->isEmpty())
    <p>Belum ada order.</p>
@else
    @foreach($orders as $order)
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <span>Order #{{ $order->id }}</span>
            <span class="badge
                {{ $order->status == 'pending' ? 'bg-warning' : '' }}
                {{ $order->status == 'diproses' ? 'bg-info' : '' }}
                {{ $order->status == 'dikirim' ? 'bg-primary' : '' }}
                {{ $order->status == 'selesai' ? 'bg-success' : '' }}">
                {{ $order->status }}
            </span>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-end fw-bold">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            <p class="text-muted small">{{ $order->created_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>
    @endforeach
@endif
@endsection
