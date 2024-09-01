@extends('layout')

@section('title')
    Edit User
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Edit {{ $user->name }}</h1>

        {{-- Success message --}}
        @include('success')

        <div class="mt-5 mb-5">
            <form action="{{ route('users.update', "$user->id") }}" method="post" class="w-75 m-auto">
                @csrf
                @method('PUT')
                {{-- Name --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                        id="exampleFormControlInput1" placeholder="Write the Task name" autocomplete="on" minlength="3"
                        required>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Email --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                        id="exampleFormControlInput2" placeholder="Write the email" autocomplete="on" required>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Role --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Role</label>
                    <select name="role" class="form-select" id="exampleFormControlInput3" autocomplete="on" required>
                        @if ($user->role === '1')
                            <option value="{{ $user->role }}" hidden>Admin</option>
                        @else
                            <option value="{{ $user->role }}" hidden>User</option>
                        @endif
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                    @error('role')
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
