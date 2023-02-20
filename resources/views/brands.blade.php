<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Производители</title>
</head>

<body>
    <ul>

        @forelse ($brands as $brand)
            <li>
                <a href="{{ route('brand.view', $brand) }}">{{ $brand->name }}</a>
            </li>
        @empty
            <li>none</li>
        @endforelse
    </ul>
</body>

</html>
