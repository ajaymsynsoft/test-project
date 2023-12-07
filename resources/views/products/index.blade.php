@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Display</div>

                    <div class="card-body row ">
                        @foreach($products as $product)
                            <div class="product col-md-4">
                                <h4>{{ $product->name }}</h4>
                                <p>{{ $product->description }}</p>
                                <p>Price: ${{ $product->price }}</p>
                            </div>
                        @endforeach

                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection