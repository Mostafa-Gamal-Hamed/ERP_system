@extends('layout')

@section('title')
    Sales
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">All sales</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-3 mb-5 overflow-x-auto">
            <div class="d-flex">
                {{-- Count --}}
                <h3 class="col-4">count : {{ $count }}</h3>
                {{-- Search --}}
                <form action="{{ route("sales.search") }}" method="GET" id="searchForm" class="col mb-3">
                    @csrf
                    <div class="d-flex gap-1">
                        <select class="form-select" name="search" id="productSearch" aria-label="Default select example" required>
                            <option hidden>Select Type</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-striped text-center" id="salesTable">
                {{-- Pagination --}}
                {{ $sales->appends(request()->input())->links() }}
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Sale_date</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td>{{ $sale->category->name }}</td>
                            <td>{{ $sale->purchase->type }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>{{ $sale->price }}</td>
                            <td>{{ $sale->total }}</td>
                            <td>{{ $sale->created_at }}</td>
                            <td>{{ $sale->updated_at }}</td>
                            <td>
                                <a href="{{ route('sales.edit', "$sale->id") }}" class="btn btn-info">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('sales.delete', "$sale->id") }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash px-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
