<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - {{ $page->title }}</title>
    <link rel="shortcut icon" href="/icon.png" type="image/png">
</head>
<body>

    {!! $page->content !!}

</body>
</html>
