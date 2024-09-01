@extends('layout')

@section('title')
    Add Report
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center text-dark fw-bold mt-4">Add report</h1>

        {{-- Success message --}}
        @include('success')
        @include('error')

        <div class="mt-5 mb-5">
            <form action="{{ route('reports.store') }}" method="post" class="w-75 m-auto">
                @csrf
                {{-- Title --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                        id="exampleFormControlInput3" placeholder="Write the title" autocomplete="on" required>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Description --}}
                <div class="mb-3 form-floating">
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" autocomplete="on"
                        required>{{ old('description') }}</textarea>
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
                        $("select[name='{{ $error }}']").css("border", "2px solid red");
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
