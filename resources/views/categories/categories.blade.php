@extends('layout')

@section('title')
    Categories
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">All categories</h1>

        {{-- Success message --}}
        @include("success")
        @include("error")

        <div class="mt-3 mb-5 overflow-x-auto">
            {{-- Add category --}}
            <div class="mb-3">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="d-flex gap-2 justify-content-end align-items-start">
                        <div style="max-width: 40%">
                            <input type="text" name="category" class="form-control" value="{{ old('category') }}"
                                placeholder="Add category">
                            @error('category')
                                <span class="text-danger d-flex justify-content-end">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>

            {{-- Categories --}}
            <table class="table table-striped text-center shadow p-3 mb-5 bg-body-tertiary rounded">
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Name</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- Edit --}}
                            <form action="{{ route('category.update', "$category->id") }}" method="POST">
                                @csrf
                                @method("PUT")
                                <td>
                                    <input type="text" name="name" value="{{ $category->name }}"
                                    class="border-0 text-center" style="background-color: transparent;">
                                </td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td>
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </td>
                            </form>

                            <td>
                                <form action="{{ route('category.delete', "$category->id") }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
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
