@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded">
        @else
            <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded" style="height:300px;">
                Tidak ada gambar
            </div>
        @endif
    </div>
    <div class="col-md-8">
        <h4>{{ $product->name }}</h4>
        <p class="text-muted">{{ $product->category->name }}</p>
        <h5 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
        <p>{{ $product->description }}</p>
        <p>Stok: {{ $product->stock }}</p>

        @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="quantity" class="form-control w-25" value="1" min="1" max="{{ $product->stock }}">
                </div>
                <button class="btn btn-primary">Tambah ke Keranjang</button>
            </form>
        @else
            <button class="btn btn-secondary" disabled>Stok Habis</button>
        @endif

        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mt-2">Kembali</a>
    </div>
</div>
@endsection
