@extends('layouts.base')

@section('content')
{{-- Navigation Header --}}
<header class="bg-background text-primary-container font-headline uppercase tracking-wider text-[0.75rem] fixed top-0 w-full border-b-4 border-black shadow-[4px_4px_0px_0px_#000000] flex justify-between items-center px-6 py-4 z-50">
    <div class="flex items-center gap-4">
        <a href="{{ url('/') }}" class="text-xl font-bold text-primary-container tracking-tighter hover:text-primary-fixed transition-colors">QUESTLEARN</a>
    </div>
    
    <div class="flex items-center gap-4">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">military_tech</span>
        
        @if(request()->routeIs('login'))
            <x-pixel-button variant="gold" size="sm" href="{{ route('register') }}">[ REGISTER ]</x-pixel-button>
        @elseif(request()->routeIs('register'))
            <x-pixel-button variant="gold" size="sm" href="{{ route('login') }}">[ LOGIN ]</x-pixel-button>
        @else
            <x-pixel-button variant="gold" size="sm" href="{{ route('login') }}">[ LOGIN ]</x-pixel-button>
        @endif
    </div>
</header>

{{-- Main Content --}}
<div class="pt-20 pb-20">
    @yield('guest-content')
</div>

{{-- Footer --}}
<footer class="bg-background text-secondary-container font-body text-lg fixed bottom-0 w-full border-t-4 border-black flex flex-col md:flex-row justify-between items-center px-8 py-6 z-50">
    <div class="text-primary-container font-headline text-xs mb-4 md:mb-0">
        QUESTLEARN // V 1.0.4
    </div>
    <div class="flex gap-8 items-center">
        <a class="hover:text-primary-container transition-colors duration-100 uppercase" href="#">TERMS</a>
        <a class="hover:text-primary-container transition-colors duration-100 uppercase" href="#">PRIVACY</a>
        <a class="hover:text-primary-container transition-colors duration-100 uppercase" href="#">SUPPORT</a>
    </div>
    <div class="mt-4 md:mt-0 text-on-surface-variant text-sm">
        &copy; {{ date('Y') }} QUESTLEARN — LEVEL UP YOUR MIND
    </div>
</footer>
@endsection
