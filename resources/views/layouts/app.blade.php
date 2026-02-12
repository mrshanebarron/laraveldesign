<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'LaravelDesign'))</title>
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        serif: ['Playfair Display', 'Georgia', 'serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fef3f2',
                            100: '#fde5e3',
                            200: '#fdd0cc',
                            300: '#faafa3',
                            400: '#f47368',
                            500: '#eb4432',
                            600: '#d92d1a',
                            700: '#b62313',
                            800: '#962113',
                            900: '#7c2116',
                            950: '#440d07',
                        },
                    },
                },
            },
        }
    </script>

    <style type="text/tailwindcss">
        body {
            @apply font-sans text-gray-900 bg-white antialiased;
        }

        /* Page builder output reset */
        .laraveldesign-builder-content img {
            @apply max-w-full h-auto;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="border-b border-gray-200 bg-white sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center group-hover:bg-brand-700 transition-colors">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-semibold text-gray-900">{{ config('app.name', 'LaravelDesign') }}</span>
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center gap-8">
                    <x-laraveldesign::menu
                        location="header"
                        class="flex items-center gap-8"
                    />
                    <a href="/blog" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Blog</a>
                </nav>

                <!-- Mobile menu button -->
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden p-2 text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 bg-white">
            <div class="px-4 py-4 space-y-2">
                <a href="/blog" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">Blog</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        @hasSection('hero')
            @yield('hero')
        @endif

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-400">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <a href="/" class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-semibold text-white">{{ config('app.name', 'LaravelDesign') }}</span>
                    </a>
                    <p class="text-sm leading-relaxed">A WordPress-like CMS for Laravel with a visual page builder. Build beautiful pages without leaving your Laravel app.</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Navigation</h3>
                    <x-laraveldesign::menu
                        location="footer"
                        class="space-y-2"
                    />
                    <a href="/blog" class="block text-sm text-gray-400 hover:text-white transition-colors mt-2">Blog</a>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Built With</h3>
                    <ul class="space-y-2 text-sm">
                        <li>Laravel 12</li>
                        <li>Filament 3</li>
                        <li>Livewire 3</li>
                        <li>GrapesJS</li>
                        <li>Tailwind CSS</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm">&copy; {{ date('Y') }} {{ config('app.name', 'LaravelDesign') }}. All rights reserved.</p>
                <p class="text-sm">Powered by <a href="https://laraveldesign.com" class="text-brand-400 hover:text-brand-300 transition-colors">LaravelDesign</a></p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
