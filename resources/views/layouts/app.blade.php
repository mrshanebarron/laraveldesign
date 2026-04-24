<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'LaravelDesign'))</title>
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="min-h-full flex flex-col bg-stone-50 text-stone-900 antialiased font-sans">

    <header class="border-b border-stone-200 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="text-xl font-serif font-bold tracking-tight text-stone-900">
                    {{ config('app.name', 'LaravelDesign') }}
                </a>

                <x-laraveldesign::menu
                    location="header"
                    class="hidden md:flex items-center gap-6 text-sm text-stone-600"
                    linkClass="hover:text-stone-900 transition-colors"
                    activeClass="text-stone-900 font-medium"
                />

                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden p-2 text-stone-600 hover:text-stone-900" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden border-t border-stone-200 bg-white">
            <x-laraveldesign::menu
                location="header"
                class="flex flex-col px-6 py-4 gap-2 text-sm text-stone-600"
                linkClass="block py-2 hover:text-stone-900 transition-colors"
                activeClass="text-stone-900 font-medium"
            />
        </div>
    </header>

    <main class="flex-1">
        @hasSection('hero')
            @yield('hero')
        @endif

        <div class="max-w-3xl mx-auto px-6 py-12 prose prose-stone prose-lg prose-headings:font-serif prose-headings:tracking-tight prose-a:text-brand-600 prose-a:no-underline hover:prose-a:underline">
            @yield('content')
        </div>
    </main>

    <footer class="border-t border-stone-200 bg-white mt-24">
        <div class="max-w-6xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8 text-sm">
            <div>
                <div class="font-serif font-bold text-lg mb-2 text-stone-900">{{ config('app.name', 'LaravelDesign') }}</div>
                <p class="text-stone-600">A WordPress-like CMS for Laravel with a visual page builder.</p>
            </div>
            <div>
                <div class="font-medium mb-2 text-stone-900">Navigation</div>
                <x-laraveldesign::menu
                    location="footer"
                    class="flex flex-col gap-1 text-stone-600"
                    linkClass="hover:text-stone-900 transition-colors"
                />
            </div>
            <div>
                <div class="font-medium mb-2 text-stone-900">Built with</div>
                <ul class="text-stone-600 space-y-1">
                    <li>Laravel 12</li>
                    <li>Filament 3</li>
                    <li>Livewire 3</li>
                    <li>GrapesJS</li>
                    <li>Tailwind CSS v4</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-stone-200">
            <div class="max-w-6xl mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between text-xs text-stone-500 gap-2">
                <div>&copy; {{ date('Y') }} {{ config('app.name', 'LaravelDesign') }}. All rights reserved.</div>
                <div>Powered by <a href="https://packagist.org/packages/mrshanebarron/laraveldesign" class="hover:text-stone-900">LaravelDesign</a></div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
