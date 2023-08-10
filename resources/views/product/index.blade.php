@extends('product.layout')

@section('content')

    <div class="d-flex justify-content-between mb-4">
        <h3>Products List</h3>
        <a class="btn btn-success btn-sm" href="{{ route('create') }}">Create New</a>
    </div>

    @if(session()->has('success'))
        <label class="alert alert-success w-100">{{session('success')}}</label>
    @elseif(session()->has('error'))
        <label class="alert alert-danger w-100">{{session('error')}}</label>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Item name</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Expire Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->expire_date }}</td>
                <td>
                    <a href="{{ route('edit', ['id' => $product->id]) }}" class="btn btn-success btn-sm">Edit</a>
                    <a href="{{ route('show', ['id' => $product->id]) }}" class="btn btn-info btn-sm">Show</a>
                    <form action="{{ route('delete', ['id' => $product->id]) }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        {{ $products->render() }}
    </div>

@endsection