<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Aide Plaies Diabétiques Madagascar - Dons pour prothèses & soins')</title>

    <meta name="description"
        content="Faites un don pour aider les personnes amputées à cause du diabète à Madagascar. Prothèses, rééducation, soins post-opératoires. Soutenez une campagne aujourd'hui.">
    <meta name="keywords"
        content="plaies diabétiques, ulcère pied diabétique, amputation diabète, prothèse diabète Madagascar, don diabète Tana, aide diabète Antananarivo">
    <meta name="robots" content="index, follow">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center">
        @yield('content')
    </div>
</body>

</html>
