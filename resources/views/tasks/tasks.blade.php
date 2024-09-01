@extends('layout')

@section('title')
    Tasks
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">All tasks</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-3 mb-5 overflow-x-auto">
            <div class="d-flex">
                {{-- Count --}}
                <h3 class="col-4">count : {{ $count }}</h3>
                {{-- Search --}}
                <form action="{{ route('tasks.search') }}" method="GET" id="searchForm" class="col mb-3">
                    @csrf
                    <div class="d-flex gap-1">
                        <input type="text" name="title" placeholder="Search by title" class="form-control" id="title">
                        <select class="form-select" name="status" id="status">
                            <option value="" hidden>Search by status</option>
                            <option value="pending">Pending</option>
                            <option value="done">Done</option>
                            <option value="canceled">Canceled</option>
                        </select>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-striped text-center" id="salesTable">
                {{-- Pagination --}}
                {{ $tasks->appends(request()->input())->links() }}
                <thead class="border">
                    <tr>
                        <th>Num</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start date</th>
                        <th>Due date</th>
                        <th>status</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>
                                <div class="form-control" style="height:auto;max-width:450px;overflow: auto;">
                                    {{ $task->description }}</div>
                            </td>
                            <td>{{ $task->start_date }}</td>
                            <td>{{ $task->due_date }}</td>
                            @if ($task->status === 'pending')
                                <td class="text-secondary fw-bold">{{ ucfirst($task->status) }}</td>
                            @elseif ($task->status === 'done')
                                <td class="text-success fw-bold">{{ ucfirst($task->status) }}</td>
                            @else
                                <td class="text-danger fw-bold">{{ ucfirst($task->status) }}</td>
                            @endif
                            <td>{{ $task->created_at }}</td>
                            <td>{{ $task->updated_at }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', "$task->id") }}" class="btn btn-info">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('tasks.delete', "$task->id") }}" method="post">
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
