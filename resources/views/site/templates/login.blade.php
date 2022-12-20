<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />

    <link rel="stylesheet" href="/assets/css/site/style.css">
    <link rel="stylesheet" href="/assets/css/site/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <div id="body">

        @yield('body')

    </div>

    <script src="/assets/js/site/login.min.js"></script>

</body>
</html>
