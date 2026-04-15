<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="QuestLearn - Level Up Your Knowledge, Track Your Guild. An RPG-style Learning Management System.">
    <title>@yield('title', 'QuestLearn') — Level Up Your Knowledge</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="pixel-grid-bg min-h-screen">
    @yield('content')
</body>
</html>
