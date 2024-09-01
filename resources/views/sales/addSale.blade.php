@extends('layout')

@section('title')
    Add Sales
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Add Sales</h1>

        {{-- Success message --}}
        @include('success')

        <div class="mt-5 mb-5">
            <form action="{{ route('sales.store') }}" method="post" class="w-75 m-auto">
                @csrf
                {{-- Customer --}}
                <div class="mb-3">
                    <label class="form-label">Customer</label>
                    <select class="form-select" name="customer" aria-label="Default select example" autocomplete="on"
                        required>
                        <option hidden>Select customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @error('customer')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Product --}}
                <div class="mb-3">
                    <label class="form-label">Product</label>
                    <select class="form-select" name="product" id="product-select" aria-label="Default select example"
                        autocomplete="on" required>
                        <option hidden>Select Product</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('product')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Type --}}
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="type" id="type-select" aria-label="Default select example"
                        autocomplete="on" required>
                        <option hidden>Select Type</option>
                    </select>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Quantity --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control"
                        id="exampleFormControlInput3" placeholder="Write the Quantity" autocomplete="on" required>
                    @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Price --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Price</label>
                    <input type="number" name="price" value="{{ old('price') }}" class="form-control"
                        id="exampleFormControlInput4" placeholder="Write the Price" step=".01" autocomplete="on"
                        required>
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Total --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput5" class="form-label">Total</label>
                    <input type="number" name="total" value="{{ old('total') }}" class="form-control"
                        id="exampleFormControlInput5" placeholder="Write the Total" step=".01" autocomplete="on"
                        required readonly>
                    @error('total')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
                // Count
                function calculateTotal() {
                    let quantity = parseInt($("input[name='quantity']").val()) || 0;
                    let price = parseFloat($("input[name='price']").val()) || 0;
                    let total = quantity * price;
                    $("input[name='total']").val(total.toFixed(2)); // Ensures the total has 2 decimal places
                }
                calculateTotal();

                $("input[name='quantity'], input[name='price']").on('input', function() {
                    calculateTotal();
                });
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
