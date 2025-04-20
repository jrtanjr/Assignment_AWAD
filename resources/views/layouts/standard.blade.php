<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    <header> <!-- insert header here --></header>
    <main>
        @yield('content')
    </main>
    <footer> <!-- insert footer here --></footer>
    @yield('script')
</body>
</html>