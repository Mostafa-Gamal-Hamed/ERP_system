@extends('layout')

@section('title')
    Customers
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">All customers</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-3 mb-5 overflow-x-auto">
            <div class="d-flex">
                {{-- Count --}}
                <h3 class="col">count : {{ $count }}</h3>
                {{-- Search --}}
                <form action="{{ route('customer.search') }}" method="GET" id="searchForm" class="col mb-3">
                    @csrf
                    <div class="d-flex gap-1">
                        <input class="form-control" type="search" name="search" id="search" placeholder="Search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-striped text-center" id="purchasesTable">
                {{-- Pagination --}}
                {{ $customers->appends(request()->input())->links() }}
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <form action="{{ route('customer.update', "$customer->id") }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <input type="text" name="name" value="{{ $customer->name }}"
                                        class="border-0 text-center" style="background-color: transparent;"
                                        autocomplete="on" minlength="3" required>
                                </td>
                                <td>
                                    <input type="email" name="email" value="{{ $customer->email }}"
                                        class="border-0 text-center" style="background-color: transparent;"
                                        autocomplete="on">
                                </td>
                                <td>
                                    <input type="number" name="phone" value="0{{ $customer->phone }}"
                                        class="border-0 text-center" style="background-color: transparent;"
                                        autocomplete="on" min="10" required>
                                </td>
                                <td>
                                    <input type="text" name="city" value="{{ $customer->city }}"
                                        class="border-0 text-center" style="background-color: transparent;"
                                        autocomplete="on" required>
                                </td>
                                <td>
                                    <input type="text" name="address" value="{{ $customer->address }}"
                                        class="border-0 text-center" style="background-color: transparent;"
                                        autocomplete="on" required>
                                </td>
                                <td>{{ $customer->created_at }}</td>
                                <td>{{ $customer->updated_at }}</td>
                                <td>
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </form>
                            <td>
                                <form action="{{ route('customer.delete', "$customer->id") }}" method="post">
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
