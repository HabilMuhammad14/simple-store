@extends('layouts.app')
@section('content')
<h4>Daftar Produk</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    @foreach($products as $product)
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:200px;">
                    Tidak ada gambar
                </div>
            @endif
            <div class="card-body">
                <h6 class="card-title">{{ $product->name }}</h6>
                <p class="text-muted small">{{ $product->category->name }}</p>
                <p class="fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="small">Stok: {{ $product->stock }}</p>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">Detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
