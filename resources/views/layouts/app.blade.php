<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Quest Translation Manager</title>
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/translation/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

    <nav class="nav" role="navigation" aria-label="Main navigation">
        <div class="nav__inner">

            {{-- Desktop links --}}
            <div class="nav__links" role="list">
                <a href="{{ route('quests.index') }}"
                   class="nav__link {{ request()->routeIs('quests.index') ? 'nav__link--active' : '' }}"
                   role="listitem">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    List Quests
                </a>
                <a href="{{ route('quests.import.form') }}"
                   class="nav__link {{ request()->routeIs('quests.import*') ? 'nav__link--active' : '' }}"
                   role="listitem">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    Import
                </a>
            </div>

            {{-- Hamburger (mobile) --}}
            <button class="nav__hamburger"
                    aria-label="Open menu"
                    aria-expanded="false"
                    aria-controls="mobile-drawer"
                    onclick="toggleDrawer(this)">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        {{-- Mobile drawer --}}
        <div class="nav__drawer" id="mobile-drawer" aria-hidden="true">
            <a href="{{ route('quests.index') }}"
               class="nav__link {{ request()->routeIs('quests.index') ? 'nav__link--active' : '' }}">
                List Quests
            </a>
            <a href="{{ route('quests.import.form') }}"
               class="nav__link {{ request()->routeIs('quests.import*') ? 'nav__link--active' : '' }}">
                Import
            </a>
        </div>
    </nav>

    <main class="main" id="main-content">

        {{-- Flash: success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert--success" role="alert">
                <svg class="alert__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <div>{{ $message }}</div>
            </div>
        @endif

        {{-- Flash: error --}}
        @if ($message = Session::get('error'))
            <div class="alert alert--error" role="alert">
                <svg class="alert__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div>{{ $message }}</div>
            </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert alert--error" role="alert">
                <svg class="alert__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
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

    <footer class="footer">
        <div class="footer__inner">
            <p class="footer__copy">Quest Translation Management System &copy; {{ date('Y') }}</p>
        </div>
    </footer>

    <script>
        function toggleDrawer(btn) {
            const drawer  = document.getElementById('mobile-drawer');
            const open    = drawer.style.display === 'flex';
            drawer.style.display = open ? 'none' : 'flex';
            btn.setAttribute('aria-expanded', String(!open));
            drawer.setAttribute('aria-hidden', String(open));
        }
    </script>
</body>
</html>