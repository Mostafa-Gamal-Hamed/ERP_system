@extends('layout')

@section('title')
    Competitions
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center fw-bold mt-4">All competitions</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-3 mb-5 overflow-x-auto">
            <div class="d-flex">
                {{-- Count --}}
                <h3 class="col-4">count : {{ $count }}</h3>
                {{-- Search --}}
                <form action="{{ route('competitions.search') }}" method="GET" id="searchForm" class="col mb-3">
                    @csrf
                    <div class="d-flex gap-1">
                        <input type="text" name="search" value="Write the name" class="form-control"
                            id="search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-striped text-center" id="salesTable">
                {{-- Pagination --}}
                {{ $competitions->appends(request()->input())->links() }}
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($competitions as $competition)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <form action="{{ route('competitions.update', "$competition->id") }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <input type="text" name="name" value="{{ $competition->name }}"
                                        class="form-control border-0 text-center" placeholder="Write the name"
                                        autocomplete="on" minlength="3" required>
                                </td>
                                <td>
                                    <textarea name="description" class="form-control border-0 text-center" cols="50" rows="5" autocomplete="on"
                                        required>
                                        {{ $competition->description }}
                                    </textarea>
                                </td>
                                <td>
                                    <input type="date" name="startDate" value="{{ $competition->start_date }}"
                                        class="form-control border-0 text-center" placeholder="Write the start date"
                                        autocomplete="on" required>
                                </td>
                                <td>
                                    <input type="date" name="endDate" value="{{ $competition->end_date }}"
                                        class="form-control border-0 text-center" placeholder="Write the end date"
                                        autocomplete="on" required>
                                </td>
                                <td>{{ $competition->created_at }}</td>
                                <td>{{ $competition->updated_at }}</td>
                                <td>
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </td>
                            </form>
                            <td>
                                <form action="{{ route('competitions.delete', "$competition->id") }}" method="post">
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
                    $("textarea[name='{{ $error }}']").css("border", "2px solid red");
                @endforeach
            });
        @endif
    </script>
@endsection
