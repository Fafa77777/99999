@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>
                <div class="card-body">
                    <img src="/images/placeholder.png" alt="{{ $product->name }}" class="img-fluid mb-3">
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p><strong>Category:</strong> {{ $product->category }}</p>
                    <p><strong>Inventory Count:</strong> {{ $product->inventory_count }}</p>
                </div>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back to Products</a>

            @if(count($recommendations) > 0)
                <div class="card mt-4">
                    <div class="card-header">Recommended Products</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($recommendations as $recommendedProduct)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="/images/placeholder.png" alt="{{ $recommendedProduct->name }}" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $recommendedProduct->name }}</h5>
                                            <p class="card-text">${{ number_format($recommendedProduct->price, 2) }}</p>
                                            <a href="{{ route('products.show', $recommendedProduct->id) }}" class="btn btn-sm btn-primary">View Product</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

                @if($product->downloadable->count() > 0 && auth()->user() && auth()->user()->hasPurchased($product))
                    <a href="{{ route('download.generate-link', $product->id) }}" class="btn btn-success mt-3">Download</a>
                @endif

            <div class="card mt-4">
                <div class="card-header">Inventory Logs</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Quantity Change</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->inventoryLogs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $log->quantity_change }}</td>
                                    <td>{{ $log->reason }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

