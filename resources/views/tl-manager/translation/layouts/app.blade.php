<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - KCIDTMS-APP</title>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('css/translation/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'display': ['Plus Jakarta Sans', 'sans-serif'],
                        'body': ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        sidebar: {
                            DEFAULT: '#0f1117',
                            hover:   '#1a1d27',
                            active:  '#1e2130',
                            border:  '#1e2436',
                        },
                        accent: {
                            DEFAULT: '#f97316',
                            muted:   'rgba(249,115,22,0.12)',
                        },
                        surface: {
                            DEFAULT: '#13161f',
                            card:    '#181c27',
                            border:  '#252a38',
                        },
                    },
                    boxShadow: {
                        'glow': '0 0 0 1px rgba(249,115,22,0.3), 0 4px 24px rgba(249,115,22,0.08)',
                    },
                }
            }
        };
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


</head>

<body class="antialiased">

    <aside id="sidebar" role="navigation" aria-label="Sidebar navigation">

        <div class="sidebar-logo">
            <h1>ignore-_quests.json</h1>
            <p>KCID_TMS-APP</p>
        </div>

        <nav class="sidebar-nav">
            <a
                href="{{ route('quests.index') }}"
                class="sidebar-link {{ request()->routeIs('quests.index') ? 'active' : '' }}"
            >
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>

            <a
                href="{{ route('quests.import.form') }}"
                class="sidebar-link {{ request()->routeIs('quests.import*') ? 'active' : '' }}"
            >
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                Import Quests
            </a>

            <a
                href="{{ route('quests.create') }}"
                class="sidebar-link {{ request()->routeIs('quests.create') ? 'active' : '' }}"
            >
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="16"/>
                    <line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
                Create New
            </a>

            <div style="height:1px; background:#1e2436; margin: 0.5rem 0;"></div>

            <a href="#" class="sidebar-link">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
                </svg>
                Settings
            </a>
        </nav>

    </aside>

    <div id="sidebar-overlay" onclick="closeSidebar()"></div>

    <header id="topbar">

        <button
            id="hamburger"
            onclick="openSidebar()"
            class="topbar-btn"
            style="display:none;"
            aria-label="Open sidebar"
        >
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>

        <div class="search-bar">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <form method="GET" action="{{ route('quests.index') }}">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search quests by title, ID, or code..."
                >
            </form>
        </div>

        <div style="flex:1;"></div>
        <div class="avatar" title="User">U</div>

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