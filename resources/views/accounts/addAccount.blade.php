@extends('layout')

@section('title')
    Add Account
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Add Account</h1>

        {{-- Success message --}}
        @include('success')

        <div class="mt-5 mb-5">
            <form action="{{ route('accounts.store') }}" method="post" class="w-75 m-auto">
                @csrf
                {{-- Account name --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Account name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        id="exampleFormControlInput1" placeholder="Write the Account name" autocomplete="on" required>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Account type --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Account type</label>
                    <input type="text" name="type" value="{{ old('type') }}" class="form-control"
                        id="exampleFormControlInput2" placeholder="Write the Account type" autocomplete="on" required>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Balance --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Balance</label>
                    <input type="number" name="balance" value="{{ old('balance') }}" class="form-control"
                        id="exampleFormControlInput3" placeholder="Write the Balance" autocomplete="on" step=".01"
                        required>
                    @error('balance')
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
        </script>
    @endsection
