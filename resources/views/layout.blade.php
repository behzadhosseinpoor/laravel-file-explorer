<!doctype html>
<html lang="en">
<head>
    <base href="/{{ config('file-explorer.path') }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="{{ asset('/vendor/file-explorer/favicon.ico') }}">
    <link href="{{ asset('/vendor/file-explorer/app.css') }}" rel="stylesheet" type="text/css">
    <title>FileExplorer{{ config('app.name') ? ' - ' . config('app.name') : '' }}</title>
    <style>
        body {
            background-color: #f7faff;
        }
    </style>
</head>
<body>
<div id="root"></div>
<script>
    window.FileExplorer = @json($fileExplorerScriptVariables);
</script>
<script src="{{ asset('/vendor/file-explorer/app.js') }}" defer></script>
</body>
</html>
