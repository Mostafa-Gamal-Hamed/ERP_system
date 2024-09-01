<!DOCTYPE html>
<html>
<head>
    <title>Report PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { width: 100%; margin: auto; padding: 20px; }
        h1 { text-align: center; }
        .content { margin-top: 30px; }
        footer{
            display: flex;
            justify-content: space-around;
            align-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>{{ $report->title }}</h1>
        </header>
        <div class="content">
            {!! $report->description !!}
        </div>
        <hr>
        <footer>
            <p><strong>User:</strong> {{ $report->user->name }}</p>
            <p><strong>Created at:</strong> {{ $report->created_at }}</p>
        </footer>
    </div>
</body>
</html>
