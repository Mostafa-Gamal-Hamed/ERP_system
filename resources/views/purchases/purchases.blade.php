@extends('layout')

@section('title')
    Purchases
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">All purchases</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-3 mb-5 overflow-x-auto">
            <div class="d-flex">
                {{-- Count --}}
                <h3 class="col-4">count : {{ $count }}</h3>
                {{-- Search --}}
                <form action="{{ route("purchases.search") }}" method="GET" id="searchForm" class="col mb-3">
                    @csrf
                    <div class="d-flex gap-1">
                        <input class="form-control" type="search" name="typeSearch" id="typeSearch" placeholder="Write th type">
                        <select class="form-select" name="productSearch" id="productSearch" aria-label="Default select example" required>
                            <option hidden>Select Product</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-striped text-center" id="purchasesTable">
                {{-- Pagination --}}
                {{ $purchases->appends(request()->input())->links() }}
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Comment</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $purchase->category->name }}</td>
                            <td>{{ $purchase->type }}</td>
                            <td>{{ $purchase->comment }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>{{ $purchase->price }}</td>
                            <td>{{ $purchase->total }}</td>
                            <td>{{ $purchase->created_at }}</td>
                            <td>{{ $purchase->updated_at }}</td>
                            <td>
                                <a href="{{ route('purchases.edit', "$purchase->id") }}" class="btn btn-info">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('purchases.delete', "$purchase->id") }}" method="post">
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
