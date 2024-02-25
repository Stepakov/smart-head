@props([
    'title',
    'h1' => null
    ])

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite([ 'resources/css/app.scss' ] )
</head>
<body>
<x-notification />
<header>
    <div class="container border-bottom pb-2">
        Header | Public | Войти
    </div>
</header>

<main>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h4 class="my-3">
                    Sidebar menu
                </h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route( 'movies.index') }}">
                            Админка
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route( 'public.movies.index') }}">
                            Фильмы
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route( 'public.genres.index') }}">
                            Жанры
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <h1>{{ $h1 ?? $title }}</h1>
                {{ $slot }}
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container border-top pt-2">
        footer
    </div>
</footer>

@vite([ 'resources/js/app.js' ] )
</body>
</html>
