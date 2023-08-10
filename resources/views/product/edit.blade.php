@extends('product.layout')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h3>Edit Product</h3>
        <a class="btn btn-success btn-sm" href="{{ route('index') }}">List Products</a>
    </div>

    @if(session()->has('success'))
        <label class="alert alert-success w-100">{{session('success')}}</label>
    @elseif(session()->has('error'))
        <label class="alert alert-danger w-100">{{session('error')}}</label>
    @endif

    <form action="{{ route('update', ['id' => $product->id]) }}" method="POST"  enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="product name" value="{{ $product->name }}">
            @if ($errors->has('name'))
            <span id="name_Error" class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group">
        <label>SKU</label>
            <input type="text" name="sku" id="sku" class="form-control" placeholder="product sku" value="{{ $product->sku }}">
            @if ($errors->has('sku'))
            <span id="sku_Error" class="text-danger">{{ $errors->first('sku') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="product price" value="{{ $product->price }}">
            @if ($errors->has('price'))
            <span id="price_Error" class="text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="file" id="file" class="form-control" placeholder="product file" >
            <img src="{{ asset('storage/images/'.$product->image) }}" class="img-fluid img-thumbnail" width="150">
            @if ($errors->has('image'))
            <span id="file_Error" class="text-danger">{{ $errors->first('image') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Expre date</label>
            <input type="text" name="date" id="date" class="date form-control" placeholder="product date" value="{{ $product->expire_date }}">
            @if ($errors->has('date'))
            <span id="date_Error" class="text-danger">{{ $errors->first('date') }}</span>
            @endif
        </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection