<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - KCIDTMS-APP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/translation/app.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="antialiased">
    <div id="sidebar-overlay" onclick="closeSidebar()"></div>
    <header
        class="fixed left-0 right-0 top-0 z-20 flex h-14 items-center gap-3 border-b border-sidebar-border bg-[#0d1018]/90 px-4 backdrop-blur-xl md:left-[210px]">

        {{-- Mobile Toggle --}}
        <button
            id="hamburger"
            onclick="openSidebar()"
            class="flex h-9 w-9 items-center justify-center rounded-xl border border-surface-border bg-surface text-slate-400 transition hover:bg-sidebar-hover hover:text-white md:hidden">

            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="18" x2="21" y2="18" />

            </svg>

        </button>

        {{-- Search --}}
        <div class="relative flex-1 min-w-0">

            <svg
                class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />

            </svg>

            <form
                method="GET"
                action="@yield('search_route')"
                class="w-full">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search quests by title, ID, or code..."
                    class="w-full rounded-xl border border-surface-border bg-surface px-4 h-9 pl-11 text-sm text-slate-200 placeholder:text-slate-500 focus:border-accent focus:outline-none focus:ring-2 focus:ring-orange-500/10">
            </form>
        </div>
        <div
            x-data="{ open: false }"
            class="relative flex items-center gap-3 border-l border-sidebar-border pl-3">
            <button
                @click="open = !open"
                class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-medium text-white">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-slate-400 capitalize">
                        {{ auth()->user()->role }}
                    </p>
                </div>
                @if(auth()->user()->profile_photo)
                    <img
                        src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                        alt=""
                        class="h-9 w-9 rounded-xl border border-sidebar-border object-cover shadow-glow">
                @else
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-sidebar-border bg-accent-muted text-sm font-bold text-orange-300 shadow-glow">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
            </button>
            <div
                x-show="open"
                x-cloak
                @click.away="open = false"
                x-transition
                class="absolute right-0 top-14 z-50 w-64 overflow-hidden rounded-2xl border border-sidebar-border bg-surface-card shadow-2xl">
                <div class="border-b border-sidebar-border p-4">
                    <p class="font-semibold text-white">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="truncate text-sm text-slate-400">
                        {{ auth()->user()->email }}
                    </p>
                </div>
                <div class="p-2">
                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-300 transition hover:bg-sidebar-hover hover:text-white">
                        Profile Settings
                    </a>
                    <form
                        method="POST"
                        action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-red-300 transition hover:bg-red-500/10">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main id="content" id="main-content">
        @if ($message = Session::get('success'))
            <div class="alert alert--success" role="alert">
                <svg class="alert__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                <div>{{ $message }}</div>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert--error" role="alert">
                <svg class="alert__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <div>{{ $message }}</div>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert--error" role="alert">
                <svg class="alert__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <div>
                    <strong>Terjadi Kesalahan:</strong>
                    <ul class="alert__list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @yield('content')
    </main>
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        }

        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            document.getElementById('sidebar-overlay').classList.add('open');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebar-overlay').classList.remove('open');
        }
    </script>
</body>
</html>