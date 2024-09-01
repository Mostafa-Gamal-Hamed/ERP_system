@extends('layout')

@section('title')
    Edit Task
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Edit {{ $task->title }}</h1>

        {{-- Success message --}}
        @include('success')

        <div class="mt-5 mb-5">
            <form action="{{ route('tasks.update', "$task->id") }}" method="post" class="w-75 m-auto">
                @csrf
                @method('PUT')
                {{-- Title --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Task title</label>
                    <input type="text" name="title" value="{{ $task->title }}" class="form-control"
                        id="exampleFormControlInput1" placeholder="Write the Task title" autocomplete="on" minlength="3"
                        required>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Description --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Description</label>
                    <input type="text" name="description" value="{{ $task->description }}" class="form-control"
                        id="exampleFormControlInput2" placeholder="Write the Description" autocomplete="on" required>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Start date --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Start date</label>
                    <input type="date" name="startDate" value="{{ $task->start_date }}" class="form-control"
                        id="exampleFormControlInput3" placeholder="Write the Start date" autocomplete="on" required>
                    @error('startDate')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Due date --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Due date</label>
                    <input type="date" name="dueDate" value="{{ $task->due_date }}" class="form-control"
                        id="exampleFormControlInput4" placeholder="Write the Due date" autocomplete="on" required>
                    @error('endDate')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" aria-label="Default select example" autocomplete="on"
                        required>
                        <option value="{{ $task->status }}" hidden>{{ ucfirst($task->status) }}</option>
                        <option value="pending">Pending</option>
                        <option value="done">Done</option>
                        <option value="canceled">Canceled</option>
                    </select>
                    @error('status')
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
