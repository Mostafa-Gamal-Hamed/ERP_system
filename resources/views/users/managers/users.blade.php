@extends('layout')

@section('title')
    Users
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">All users</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-3 mb-5 overflow-x-auto">
            <div class="d-flex">
                {{-- Count --}}
                <h3 class="col">count : {{ $count }}</h3>
                {{-- Search --}}
                <form action="{{ route('users.search') }}" method="GET" id="searchForm" class="col mb-3">
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
                {{ $users->appends(request()->input())->links() }}
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if ($user->role === '1')
                                <td>
                                    <form action="{{ route('users.change',"$user->id") }}" method="post">
                                        @csrf
                                        @method("PUT")
                                        <button type="submit" onclick="return confirm('do you want it be user?')" class="btn btn-sm btn-warning">Admin</button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <form action="{{ route('users.change',"$user->id") }}" method="post">
                                        @csrf
                                        @method("PUT")
                                        <button type="submit" onclick="return confirm('do you want it be admin?')" class="btn btn-sm btn-primary">User</button>
                                    </form>
                                </td>
                            @endif
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <a href="{{ route('users.edit', "$user->id") }}" class="btn btn-info">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('users.delete', "$user->id") }}" method="post">
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
