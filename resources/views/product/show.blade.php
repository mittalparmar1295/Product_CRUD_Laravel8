@extends('product.layout')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h3>Show Product</h3>
        <a class="btn btn-success btn-sm" href="{{ route('index') }}">List Products</a>
    </div>

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" disabled>
    </div>
    <div class="form-group">
        <label>SKU</label>
        <input type="text" name="sku" class="form-control" value="{{ $product->sku }}" disabled>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="text" name="price" class="form-control" value="{{ $product->price }}" disabled>
    </div>
    <div class="form-group">
        <label>Image</label>
        <img src="{{ asset('storage/images/'.$product->image) }}" class="img-fluid img-thumbnail" width="150">
    </div>
    <div class="form-group">
        <label>Expre date</label>
        <input type="text" name="price" class="form-control" value="{{ $product->expire_date }}" disabled>
    </div>
@endsection