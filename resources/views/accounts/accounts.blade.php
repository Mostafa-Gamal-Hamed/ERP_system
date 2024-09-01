@extends('layout')

@section('title')
    Accounts
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">All accounts</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-3 mb-5 overflow-x-auto">
            <div class="d-flex">
                {{-- Count --}}
                <h3 class="col-4">count : {{ $count }}</h3>
                {{-- Search --}}
                <form action="{{ route('accounts.search') }}" method="GET" id="searchForm" class="col mb-3">
                    @csrf
                    <div class="d-flex gap-1">
                        <input type="text" name="search" value="{{ old('search') }}" class="form-control" id="search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-striped text-center" id="salesTable">
                {{-- Pagination --}}
                {{ $accounts->appends(request()->input())->links() }}
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Blance</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <form action="{{ route('accounts.update', "$account->id") }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <input type="text" name="name" value="{{ $account->account_name }}"
                                        class="form-control border-0 text-center" id="exampleFormControlInput3"
                                        placeholder="Write the account name" autocomplete="on" required>
                                </td>
                                <td>
                                    <input type="text" name="type" value="{{ $account->account_type }}"
                                        class="form-control border-0 text-center" id="exampleFormControlInput3"
                                        placeholder="Write the account type" autocomplete="on" required>
                                </td>
                                <td>
                                    <input type="number" name="balance" value="{{ $account->balance }}"
                                        class="form-control border-0 text-center" id="exampleFormControlInput3"
                                        placeholder="Write the account name" autocomplete="on" required>
                                </td>
                                <td>{{ $account->created_at }}</td>
                                <td>{{ $account->updated_at }}</td>
                                <td>
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </td>
                            </form>
                            <td>
                                <form action="{{ route('accounts.delete', "$account->id") }}" method="post">
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
