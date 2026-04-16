<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="QuestLearn - Level Up Your Knowledge, Track Your Guild. An RPG-style Learning Management System.">
    <title>@yield('title', 'QuestLearn') — Level Up Your Knowledge</title>

    {{-- Google Fonts: Press Start 2P + VT323 --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">

    {{-- Material Symbols Outlined Icon Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background min-h-screen font-body selection:bg-primary-container selection:text-on-primary-container overflow-x-hidden">
    {{-- CRT Scanline Overlay --}}
    <x-scanline-overlay />

    {{-- Pixel Grid Background --}}
    <div class="pixel-dot-bg fixed inset-0 pointer-events-none opacity-50"></div>

    @yield('content')
</body>
</html>
