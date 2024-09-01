@extends('layout')

@section('title')
    Add customer
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Add customer</h1>

        {{-- Success message --}}
        @include('success')

        <div class="mt-5 mb-5">
            <form action="{{ route('customer.store') }}" method="post" class="w-75 m-auto">
                @csrf
                {{-- Name --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Full name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        id="exampleFormControlInput1" placeholder="Write the name" autocomplete="on" minlength="3" required>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Email --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                        id="exampleFormControlInput2" placeholder="Write the email" autocomplete="on">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Phone --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Phone</label>
                    <input type="number" name="phone" value="{{ old('phone') }}" class="form-control"
                        id="exampleFormControlInput3" placeholder="Write the phone" autocomplete="on" min="10" required>
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- City --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" class="form-control"
                        id="exampleFormControlInput4" placeholder="Write the city" autocomplete="on" required>
                    @error('city')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Address --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput5" class="form-label">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                        id="exampleFormControlInput5" placeholder="Write the address" autocomplete="on" required>
                    @error('address')
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
                    @endforeach
                });
            @endif
        </script>
@endsection
