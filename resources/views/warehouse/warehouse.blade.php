@extends('layout')

@section('title')
    Warehouse
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">All stock</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-3 mb-5 overflow-x-auto">
            <div class="d-flex">
                {{-- Count --}}
                <h3 class="col-4">count : {{ $count }}</h3>
                {{-- Search --}}
                <form action="{{ route('warehouse.search') }}" method="GET" id="searchForm" class="col mb-3">
                    @csrf
                    <div class="d-flex gap-1">
                        <input type="date" name="search" class="form-control" id="productSearch">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-striped text-center" id="salesTable">
                {{-- Pagination --}}
                {{ $stock->appends(request()->input())->links() }}
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock as $stock)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <form action="{{ route('warehouse.update', "$stock->id") }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <select class="form-select border-0 text-center" name="product" id="product-select"
                                        aria-label="Default select example" autocomplete="on" required>
                                        <option value="{{ $stock->category->id }}" hidden>{{ $stock->category->name }}
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select border-0 text-center" name="type" id="type-select"
                                        aria-label="Default select example" autocomplete="on" required>
                                        <option value="{{ $stock->purchase->id }}" hidden>{{ $stock->purchase->type }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="quantity" value="{{ $stock->quantity }}"
                                        class="form-control border-0 text-center" id="exampleFormControlInput3" placeholder="Write the Quantity"
                                        autocomplete="on" required>
                                </td>
                                <td>{{ $stock->created_at }}</td>
                                <td>{{ $stock->updated_at }}</td>
                                <td>
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </td>
                            </form>
                            <td>
                                <form action="{{ route('warehouse.delete', "$stock->id") }}" method="post">
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

    {{-- Jquery --}}
    <script>
        // Validation
        @if ($errors->any())
            $(document).ready(function() {
                @foreach ($errors->keys() as $error)
                    $("input[name='{{ $error }}']").css("border", "2px solid red");
                    $("select[name='{{ $error }}']").css("border", "2px solid red");
                @endforeach
            });
        @endif

        $(document).ready(function() {
            // Show type
            $('#product-select').on('change', function() {
                var productId = $(this).val();
                $('#type-select').empty().append('<option hidden>Select Type</option>');
                if (productId) {
                    $.ajax({
                        url: "{{ url('/get-product-types') }}/" + productId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $.each(data, function(key, value, quantity) {
                                    $('#type-select').append('<option value="' + key +
                                        '">' + value + '</option>');
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
