@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-12">
                    <div class="card shadow-0 border rounded-3 mb-3">
                    <div class="card-body">
                        <div class="row g-0">
                        <div class="col-xl-3 col-md-4 d-flex justify-content-center">
                            <div class="bg-image hover-zoom ripple rounded ripple-surface me-md-3 mb-3 mb-md-0">
                            <img src="{{$product->thumbnail}}" class="w-100">
                            <a href="#!">
                                <div class="hover-overlay">
                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                </div>
                            </a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-8 col-sm-7">
                            <div class="d-flex flex-row">
                                <bagde>{{ $product->brand }}</badge>
                                <span class="badge rounded-pill text-bg-dark">{{ $product->category }}</span>
                            </div>
                            <h4 class='mt-2 mb-1 fw-bold'>{{ $product->title }}</h4>
                            <p class="h6 badge mb-0 text-bg-warning"> ★ {{ $product->rating }} </p>

                            <p class="mt-2 mb-4 mb-md-0">{{ $product->description }}</p>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-row align-items-center mb-1">
                            <h4 class="mb-1 me-1"><strong>${{ $product->price }}</strong></h4>
                            </div>
                            <span class="text-danger">▲{{ $product->discountPercentage }}%</span>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
          </div>
          <div class='d-flex justify-content-center'>
              {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection