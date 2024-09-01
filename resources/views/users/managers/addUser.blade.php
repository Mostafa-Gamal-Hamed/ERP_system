@extends('layout')

@section('title')
    Add user
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Add user</h1>

        {{-- Success message --}}
        @include('success')

        <div class="mt-5 mb-5">
            <form action="{{ route('users.store') }}" method="post" class="w-75 m-auto">
                @csrf
                {{-- Name --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        id="exampleFormControlInput1" placeholder="Write the user name" autocomplete="on" minlength="3"
                        required>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Email --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                        id="exampleFormControlInput2" placeholder="Write the email" autocomplete="on" required>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password"
                        placeholder="Write the password" autocomplete="on" required>
                        <i class="fa-solid fa-eye" id="togglePassword"></i>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="pass_confirm" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                        class="form-control" id="pass_confirm" placeholder="Repeat the password" autocomplete="on" required>
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <p id="password-match-message" class="text-danger" style="display:none;">Passwords do not match.</p>
                </div>
                {{-- Role --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Role</label>
                    <select name="role" class="form-select" id="exampleFormControlInput3" autocomplete="on" required>
                        <option value="" hidden>Select role</option>
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
            $(document).ready(function() {
                // Validation
                @if ($errors->any())
                    @foreach ($errors->keys() as $error)
                        $("input[name='{{ $error }}']").css("border", "2px solid red");
                        $("select[name='{{ $error }}']").css("border", "2px solid red");
                    @endforeach
                @endif
                // Toggle visibility for Password
                $('#togglePassword').on('click', function() {
                    var passwordField    = $('#password');
                    var passConfirmField = $('#pass_confirm');
                    var passType         = passwordField.attr('type') === 'password' ? 'text' : 'password';
                    var passConfirmType  = passConfirmField.attr('type') === 'password' ? 'text' : 'password';
                    passwordField.attr('type', passType);
                    passConfirmField.attr('type', passConfirmType);
                });
                // Check if passwords match
                $('#password, #pass_confirm').on('keyup', function() {
                    var password = $('#password').val();
                    var passConfirm = $('#pass_confirm').val();
                    var message = $('#password-match-message');

                    if (password !== passConfirm) {
                        message.show();
                    } else {
                        message.hide();
                    }
                });
            });
        </script>
    @endsection
