@extends('layout')

@section('title')
    Add purchases
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Add purchase</h1>

        {{-- Success message --}}
        @include('success')

        <div class="mt-5 mb-5">
            <form action="{{ route('purchases.store') }}" method="post" class="w-75 m-auto">
                @csrf
                {{-- Product --}}
                <div class="mb-3">
                    <label class="form-label">Product</label>
                    <select class="form-select" name="product" aria-label="Default select example" autocomplete="on" required>
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
                    <label for="exampleFormControlInput1" class="form-label">Type</label>
                    <input type="text" name="type" value="{{ old('type') }}" class="form-control"
                        id="exampleFormControlInput1" placeholder="Write the type" autocomplete="on" required>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Comment --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Comment</label>
                    <input type="text" name="comment" value="{{ old('comment') }}" class="form-control"
                        id="exampleFormControlInput2" placeholder="Write the comment" autocomplete="on">
                    @error('comment')
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
            // Count
            $(document).ready(function() {
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
            });
        </script>
@endsection
