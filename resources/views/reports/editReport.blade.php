@extends('layout')

@section('title')
    Edit report
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Edit {{ $report->title }}</h1>

        {{-- Success message --}}
        @include('success')

        <div class="mt-5 mb-5">
            <form action="{{ route('reports.update', "$report->id") }}" method="post" class="w-75 m-auto">
                @csrf
                @method('PUT')
                {{-- Title --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Title</label>
                    <input type="text" name="title" value="{{ $report->title }}" class="form-control"
                        id="exampleFormControlInput3" placeholder="Write the title" autocomplete="on" required>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Old description --}}
                <div class="mb-3">
                    <label class="form-label">Old description</label>
                    <div class="border">{!! $report->description !!}</div>
                </div>
                {{-- Description --}}
                <div class="mb-3 form-floating">
                    <textarea class="form-control" name="description" id="description"
                    placeholder="New description" autocomplete="on" required></textarea>
                    @error('description')
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
                        $("textarea[name='{{ $error }}']").css("border", "2px solid red");
                    @endforeach
                });
            @endif

            // Eritor
            $(document).ready(function() {
                // Edit in content
                CKEDITOR.replace('description', {
                    extraPlugins: 'justify',
                    toolbar: [{
                            name: 'document',
                            items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']
                        },
                        {
                            name: 'basicstyles',
                            items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                                '-', 'RemoveFormat'
                            ]
                        },
                        {
                            name: 'paragraph',
                            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                                'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter',
                                'JustifyRight', 'JustifyBlock'
                            ]
                        },
                        {
                            name: 'styles',
                            items: ['Styles', 'Format', 'Font', 'FontSize']
                        },
                        {
                            name: 'colors',
                            items: ['TextColor', 'BGColor']
                        },
                        {
                            name: 'tools',
                            items: ['Maximize', 'ShowBlocks']
                        }
                    ]
                });
            });
        </script>
@endsection
