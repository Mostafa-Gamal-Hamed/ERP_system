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
            <form action="{{ route('competitions.store') }}" method="post" class="w-75 m-auto">
                @csrf
                {{-- Competition name --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Competition name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        id="exampleFormControlInput1" placeholder="Write the Competition name" autocomplete="on" minlength="3" required>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Description --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="form-control"
                        id="exampleFormControlInput2" placeholder="Write the Description" autocomplete="on" required>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Start date --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Start date</label>
                    <input type="date" name="startDate" value="{{ old('startDate') }}" class="form-control"
                        id="exampleFormControlInput3" placeholder="Write the Start date" autocomplete="on"
                        required>
                    @error('startDate')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- End date --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">End date</label>
                    <input type="date" name="endDate" value="{{ old('endDate') }}" class="form-control"
                        id="exampleFormControlInput4" placeholder="Write the End date" autocomplete="on"
                        required>
                    @error('endDate')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
    </script>
@endsection
