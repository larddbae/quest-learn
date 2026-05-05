@extends('layouts.base')

@section('content')

<style>
    html { scroll-behavior: smooth; }
    /* Active Link Styles */
    .nav-link.active {
        color: #facc15; /* Tailwind yellow-400 */
        border-bottom: 4px solid #facc15;
        padding-bottom: 0.25rem;
    }
</style>

{{-- ============================================================
     NAVBAR — Fixed Top Navigation
     ============================================================ --}}
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-6 py-4 bg-background border-b-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
    <div class="text-2xl font-headline text-primary-container tracking-tighter">
        <a href="{{ url('/') }}">QUESTLEARN</a>
    </div>
    <div class="hidden md:flex space-x-6">
        <a class="nav-link font-headline uppercase tracking-wider text-[0.75rem] text-white/70 hover:text-primary-container hover:bg-surface-container-high hover:translate-y-[2px] transition-all" data-target="quests" href="{{ url('/#quests') }}">QUESTS</a>
        <a class="nav-link font-headline uppercase tracking-wider text-[0.75rem] text-white/70 hover:text-primary-container transition-colors hover:bg-surface-container-high hover:translate-y-[2px] transition-all" data-target="equipment" href="{{ url('/#equipment') }}">EQUIPMENT</a>
        <a class="nav-link font-headline uppercase tracking-wider text-[0.75rem] text-white/70 hover:text-primary-container transition-colors hover:bg-surface-container-high hover:translate-y-[2px] transition-all" data-target="guilds" href="{{ url('/#guilds') }}">GUILDS</a>
        <a class="nav-link font-headline uppercase tracking-wider text-[0.75rem] text-white/70 hover:text-primary-container transition-colors hover:bg-surface-container-high hover:translate-y-[2px] transition-all" data-target="lore" href="{{ url('/#lore') }}">LORE</a>
    </div>
    <div class="flex items-center gap-4">
        @if(request()->routeIs('login'))
            <a href="{{ route('register') }}" class="font-headline uppercase tracking-wider text-[0.75rem] text-primary-container hover:bg-surface-container-high hover:translate-y-[2px] transition-all active:translate-y-[4px] active:shadow-none border-2 border-primary-container px-4 py-2">[ REGISTER ]</a>
        @else
            <a href="{{ route('login') }}" class="font-headline uppercase tracking-wider text-[0.75rem] text-primary-container hover:bg-surface-container-high hover:translate-y-[2px] transition-all active:translate-y-[4px] active:shadow-none border-2 border-primary-container px-4 py-2">[ LOGIN ]</a>
        @endif
    </div>
</nav>

{{-- Main Content --}}
<div class="pt-20">
    @yield('public-content')
</div>

{{-- ============================================================
     FOOTER
     ============================================================ --}}
<footer class="w-full py-12 px-8 flex flex-col md:flex-row justify-between items-center gap-8 bg-surface-container-low border-t-4 border-black relative z-40">
    <div class="font-headline text-primary-container text-sm">QUESTLEARN</div>
    <div class="flex flex-wrap justify-center gap-6 font-body text-lg tracking-wide text-slate-400">
        <a class="hover:text-primary-container transition-colors hover:translate-x-1 duration-75" href="{{ route('privacy') }}">PRIVACY</a>
        <a class="hover:text-primary-container transition-colors hover:translate-x-1 duration-75" href="{{ route('terms') }}">TERMS</a>
        <a class="hover:text-primary-container transition-colors hover:translate-x-1 duration-75" href="{{ route('support') }}">SUPPORT</a>
    </div>
    <div class="font-body text-lg tracking-wide text-slate-400">
        &copy; {{ date('Y') }} QUESTLEARN HUD — LEVEL UP YOUR KNOWLEDGE
    </div>
</footer>

{{-- ============================================================
     SCROLL SPY SCRIPT
     ============================================================ --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        if (sections.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                let currentSectionId = '';
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        currentSectionId = entry.target.getAttribute('id');
                    }
                });

                if (currentSectionId) {
                    navLinks.forEach(link => {
                        link.classList.remove('text-yellow-400', 'border-b-4', 'border-yellow-400', 'pb-1');
                        link.classList.add('text-white/70');
                        
                        if (link.getAttribute('data-target') === currentSectionId) {
                            link.classList.remove('text-white/70');
                            link.classList.add('text-yellow-400', 'border-b-4', 'border-yellow-400', 'pb-1');
                        }
                    });
                }
            }, {
                rootMargin: '-20% 0px -60% 0px',
                threshold: 0
            });

            sections.forEach(section => observer.observe(section));
            
            // Check initial load hash if any
            if(window.location.hash) {
                const targetId = window.location.hash.substring(1);
                navLinks.forEach(link => {
                    if (link.getAttribute('data-target') === targetId) {
                        link.classList.remove('text-white/70');
                        link.classList.add('text-yellow-400', 'border-b-4', 'border-yellow-400', 'pb-1');
                    }
                });
            }
        }
    });
</script>

@endsection
