@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Order</h4>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Pembeli</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->user->name }}</td>
            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            <td>
                <span class="badge
                    {{ $order->status == 'pending' ? 'bg-warning' : '' }}
                    {{ $order->status == 'diproses' ? 'bg-info' : '' }}
                    {{ $order->status == 'dikirim' ? 'bg-primary' : '' }}
                    {{ $order->status == 'selesai' ? 'bg-success' : '' }}">
                    {{ $order->status }}
                </span>
            </td>
            <td>{{ $order->created_at->format('d-m-Y') }}</td>
            <td>
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select form-select-sm d-inline w-auto">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button class="btn btn-sm btn-primary">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
