<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'История') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=merriweather:400,700|playfair-display:400,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-serif antialiased bg-parchment-100 text-ink-500 min-h-full">
        <div class="min-h-full">
            <!-- Navigation -->
            <nav class="bg-white shadow-sm border-b border-parchment-300">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="flex-shrink-0">
                                <a href="{{ route('home') }}" class="text-2xl font-display font-bold text-ink-500 hover:text-gold-500 transition-colors">
                                    📜 История
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                    {{ __('Главная') }}
                                </x-nav-link>
                                <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')">
                                    {{ __('Статьи') }}
                                </x-nav-link>
                                <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                                    {{ __('Категории') }}
                                </x-nav-link>
                                <x-nav-link :href="route('tags.index')" :active="request()->routeIs('tags.*')">
                                    {{ __('Теги') }}
                                </x-nav-link>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            @auth
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-ink-500 bg-white hover:text-ink-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>
                                            <div class="ml-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Профиль') }}
                                        </x-dropdown-link>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Выйти') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @else
                                <a href="{{ route('login') }}" class="text-ink-500 hover:text-gold-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Войти</a>
                                <a href="{{ route('register') }}" class="ml-4 bg-gold-500 hover:bg-gold-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Регистрация</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-ink-500 text-parchment-100 mt-16">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p class="text-sm">
                            © {{ date('Y') }} История. Все права защищены.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
