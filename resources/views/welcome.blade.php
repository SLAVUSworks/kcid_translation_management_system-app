<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'KCID TMS') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }

            body::before {
                content: '';
                position: fixed;
                inset: 0;
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");
                opacity: 0.03;
                pointer-events: none;
                z-index: 0;
            }

            .panel-border::before {
                content: '';
                position: absolute;
                inset: 0;
                border-radius: 1rem;
                padding: 1px;
                background: linear-gradient(135deg, rgba(249,115,22,0.25) 0%, transparent 60%);
                -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                -webkit-mask-composite: xor;
                mask-composite: exclude;
                pointer-events: none;
            }

            .btn-glow:hover {
                box-shadow: 0 0 0 1px rgba(249,115,22,0.3), 0 4px 24px rgba(249,115,22,0.08);
            }
        </style>
    </head>
    <body class="bg-[#13161f] text-[#f1f2f6] min-h-screen antialiased">
        <div class="fixed pointer-events-none z-0 rounded-full blur-[120px] w-[600px] h-[600px] -top-[200px] -right-[150px] bg-[rgba(249,115,22,0.07)]"></div>
        <div class="fixed pointer-events-none z-0 rounded-full blur-[120px] w-[400px] h-[400px] -bottom-[100px] -left-[100px] bg-[rgba(249,115,22,0.04)]"></div>
        <div class="fixed right-0 top-0 bottom-0 w-1/2 z-0 pointer-events-none">
            <img src="https://safebooru.org//samples/567/sample_2d57967d114c18f7d50e51752acb99ae68a53ad7.jpg?6653367"
                 alt=""
                 class="w-full h-full object-cover opacity-20">
        </div>
        <div class="relative z-[1] min-h-screen flex flex-col">
            <nav class="flex items-center justify-between px-8 py-2 backdrop-blur-xl sticky top-0 z-10">
                <a href="/" class="flex items-center gap-2.5 no-underline">
                    <div class="h-11 flex items-center justify-center">
                        <img src="https://github.com/SLAVUSworks/KanColle-Indonesia-Patch-KCCP/blob/(dropped)-development/Non-Game%20Assets/banner.png?raw=true"
                             class="h-9 w-auto rounded-xl object-cover"
                             alt="KCID Logo">
                    </div>
                </a>
                <div class="flex items-center gap-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="px-4 py-[7px] text-[13px] font-medium text-[#f1f2f6] bg-transparent border border-[#252a38] rounded-lg no-underline transition-all duration-150 hover:border-[rgba(249,115,22,0.4)] hover:bg-[rgba(249,115,22,0.12)]">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="px-4 py-[7px] text-[13px] font-medium text-[#8892a4] bg-transparent border border-transparent rounded-lg no-underline transition-all duration-150 hover:text-[#f1f2f6] hover:border-[#252a38] hover:bg-[#1a1d27]">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="px-4 py-[7px] text-[13px] font-medium text-[#f1f2f6] bg-transparent border border-[#252a38] rounded-lg no-underline transition-all duration-150 hover:border-[rgba(249,115,22,0.4)] hover:bg-[rgba(249,115,22,0.12)]">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
            <main class="flex-1 grid grid-cols-2 max-lg:grid-cols-1 gap-0 max-w-[1200px] mx-auto w-full px-8 py-20 max-lg:py-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-[5px] bg-[rgba(249,115,22,0.12)] border border-[rgba(249,115,22,0.2)] rounded-full text-[12px] font-medium text-[#f97316] mb-7 tracking-[0.01em]">
                        KanColle Indonesia Patch
                    </div>
                    <h1 class="text-[52px] max-lg:text-[38px] max-sm:text-[30px] font-extrabold leading-[1.08] tracking-[-0.03em] text-[#f1f2f6] mb-5">
                        KCID <span class="text-[#f97316]">Translation</span><br>
                        Management<br>
                        System
                    </h1>
                    <p class="text-base font-normal leading-[1.7] text-[#8892a4] max-w-[440px] mb-10">
                        Patch Bahasa Indonesia untuk Web Game KanColle.
                    </p>
                    <div class="flex items-center gap-3 flex-wrap max-sm:flex-col max-sm:items-start">
                        <a href="/admin"
                           class="btn-glow inline-flex items-center gap-2 px-6 py-3 bg-[#f97316] text-white text-sm font-semibold rounded-[10px] no-underline border-0 transition-all duration-150 hover:bg-[#ea6c0f] hover:-translate-y-px active:translate-y-0">
                            Open Dashboard
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="https://github.com/SLAVUSworks/kcid_translation_management_system-app"
                           target="_blank"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-[#181c27] text-[#f1f2f6] text-sm font-medium rounded-[10px] no-underline border border-[#252a38] transition-all duration-150 hover:border-[rgba(249,115,22,0.3)] hover:bg-[#1a1d27]">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 1.5C4.41 1.5 1.5 4.41 1.5 8c0 2.87 1.86 5.3 4.44 6.16.32.06.44-.14.44-.31v-1.09c-1.8.39-2.18-.87-2.18-.87-.29-.75-.72-.95-.72-.95-.59-.4.04-.4.04-.4.65.05 1 .67 1 .67.58 1 1.53.71 1.9.54.06-.42.23-.71.41-.87-1.44-.16-2.95-.72-2.95-3.2 0-.71.25-1.29.67-1.74-.07-.16-.29-.82.06-1.71 0 0 .55-.18 1.8.67.52-.14 1.08-.22 1.63-.22s1.11.08 1.63.22c1.25-.85 1.8-.67 1.8-.67.35.89.13 1.55.06 1.71.42.45.67 1.03.67 1.74 0 2.49-1.52 3.04-2.96 3.2.23.2.44.59.44 1.19v1.77c0 .17.12.37.44.31A6.502 6.502 0 0 0 14.5 8C14.5 4.41 11.59 1.5 8 1.5Z" fill="currentColor"/>
                            </svg>
                            View Repository
                        </a>
                    </div>
                </div>
                <div class="flex justify-center items-start pl-[60px] max-lg:pl-0 max-lg:justify-start">
                    <div class="panel-border relative bg-[#181c27] border border-[#252a38] rounded-2xl p-7 w-[340px] max-lg:w-full max-lg:max-w-[420px] overflow-hidden">
                        <div class="flex items-center justify-between mb-5">
                            <span class="text-[13px] font-semibold text-[#f1f2f6] tracking-[0.01em]">Quick Access</span>
                        </div>
                        <div class="flex flex-col gap-2.5 mb-5">
                            <a href="https://github.com/Oradimi/KanColle-English-Patch-KCCP"
                               target="_blank"
                               class="flex items-center gap-3 px-3.5 py-3 bg-[#1a1d27] border border-[#1e2436] rounded-[10px] no-underline transition-all duration-150 hover:border-[rgba(249,115,22,0.3)] hover:bg-[#1e2130] group">
                                <div class="w-[34px] h-[34px] bg-[rgba(249,115,22,0.12)] rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-[#f97316]" viewBox="0 0 16 16" fill="none">
                                        <path d="M8 1.5C4.41 1.5 1.5 4.41 1.5 8c0 2.87 1.86 5.3 4.44 6.16.32.06.44-.14.44-.31v-1.09c-1.8.39-2.18-.87-2.18-.87-.29-.75-.72-.95-.72-.95-.59-.4.04-.4.04-.4.65.05 1 .67 1 .67.58 1 1.53.71 1.9.54.06-.42.23-.71.41-.87-1.44-.16-2.95-.72-2.95-3.2 0-.71.25-1.29.67-1.74-.07-.16-.29-.82.06-1.71 0 0 .55-.18 1.8.67.52-.14 1.08-.22 1.63-.22s1.11.08 1.63.22c1.25-.85 1.8-.67 1.8-.67.35.89.13 1.55.06 1.71.42.45.67 1.03.67 1.74 0 2.49-1.52 3.04-2.96 3.2.23.2.44.59.44 1.19v1.77c0 .17.12.37.44.31A6.502 6.502 0 0 0 14.5 8C14.5 4.41 11.59 1.5 8 1.5Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-[13px] font-semibold text-[#f1f2f6] mb-0.5 truncate">KanColle English Patch</div>
                                    <div class="text-[11px] text-[#4e5668]">Oradimi / KanColle-English-Patch-KCCP</div>
                                </div>
                                <div class="text-[#4e5668] shrink-0">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 14 14" fill="none">
                                        <path d="M2.5 7H11.5M11.5 7L7.5 3M11.5 7L7.5 11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </a>
                            <a href="https://github.com/SLAVUSworks/KanColle-Indonesia-Patch-KCCP"
                               target="_blank"
                               class="flex items-center gap-3 px-3.5 py-3 bg-[#1a1d27] border border-[#1e2436] rounded-[10px] no-underline transition-all duration-150 hover:border-[rgba(249,115,22,0.3)] hover:bg-[#1e2130] group">
                                <div class="w-[34px] h-[34px] bg-[rgba(249,115,22,0.12)] rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-[#f97316]" viewBox="0 0 16 16" fill="none">
                                        <path d="M8 1.5C4.41 1.5 1.5 4.41 1.5 8c0 2.87 1.86 5.3 4.44 6.16.32.06.44-.14.44-.31v-1.09c-1.8.39-2.18-.87-2.18-.87-.29-.75-.72-.95-.72-.95-.59-.4.04-.4.04-.4.65.05 1 .67 1 .67.58 1 1.53.71 1.9.54.06-.42.23-.71.41-.87-1.44-.16-2.95-.72-2.95-3.2 0-.71.25-1.29.67-1.74-.07-.16-.29-.82.06-1.71 0 0 .55-.18 1.8.67.52-.14 1.08-.22 1.63-.22s1.11.08 1.63.22c1.25-.85 1.8-.67 1.8-.67.35.89.13 1.55.06 1.71.42.45.67 1.03.67 1.74 0 2.49-1.52 3.04-2.96 3.2.23.2.44.59.44 1.19v1.77c0 .17.12.37.44.31A6.502 6.502 0 0 0 14.5 8C14.5 4.41 11.59 1.5 8 1.5Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-[13px] font-semibold text-[#f1f2f6] mb-0.5 truncate">KanColle Indonesia Patch</div>
                                    <div class="text-[11px] text-[#4e5668]">SLAVUSworks / KanColle-Indonesia-Patch-KCCP</div>
                                </div>
                                <div class="text-[#4e5668] shrink-0">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 14 14" fill="none">
                                        <path d="M2.5 7H11.5M11.5 7L7.5 3M11.5 7L7.5 11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="h-px bg-[#252a38] mb-5"></div>
                        <a href="/admin"
                           class="btn-glow flex items-center justify-between px-3.5 py-3 bg-[#f97316] rounded-[10px] no-underline cursor-pointer transition-all duration-150 hover:bg-[#ea6c0f] w-full">
                            <span class="text-[13px] font-semibold text-white">Open Admin Dashboard</span>
                            <span class="text-white/80">
                                <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none">
                                    <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </main>
            <div class="border-t border-[#1e2436] bg-[rgba(15,17,23,0.4)]">
                <div class="max-w-[1200px] mx-auto px-8 grid grid-cols-4 max-sm:grid-cols-2 divide-x divide-[#1e2436] max-sm:divide-x-0">
                    <div class="py-6 px-8 first:pl-0 last:pr-0 flex flex-col gap-1 max-sm:border-b max-sm:border-[#1e2436]">
                        <div class="text-2xl font-bold text-[#f1f2f6] tracking-[-0.02em]">
                            Laravel <span class="text-[#f97316]">v{{ app()->version() }}</span>
                        </div>
                        <div class="text-xs text-[#4e5668] font-normal">Framework version</div>
                    </div>
                    <div class="py-6 px-8 flex flex-col gap-1 max-sm:border-b max-sm:border-[#1e2436]">
                        <div class="text-2xl font-bold text-[#f1f2f6] tracking-[-0.02em]">
                            PHP <span class="text-[#f97316]">v{{ PHP_VERSION }}</span>
                        </div>
                        <div class="text-xs text-[#4e5668] font-normal">Runtime</div>
                    </div>
                    <div class="py-6 px-8 flex flex-col gap-1">
                        <div class="text-2xl font-bold text-[#f1f2f6] tracking-[-0.02em]">
                            <span class="text-[#f97316]">KCID</span>
                        </div>
                        <div class="text-xs text-[#4e5668] font-normal">Patch project</div>
                    </div>
                    <div class="py-6 px-8 last:pr-0 flex flex-col gap-1">
                        <div class="text-2xl font-bold text-[#f1f2f6] tracking-[-0.02em]">
                            <span class="text-[#f97316]">Open</span> Source
                        </div>
                        <div class="text-xs text-[#4e5668] font-normal">Community driven</div>
                    </div>
                </div>
            </div>
            <footer class="px-8 py-5 border-t border-[#1e2436] flex items-center justify-between relative z-[1] max-sm:flex-col max-sm:gap-2 max-sm:text-center">
                <div class="text-xs text-[#f1f2f6]">
                    KCID Translation Management System &mdash;
                    <a href="https://github.com/laravel/framework/blob/13.x/CHANGELOG.md"
                       target="_blank"
                       class="text-[#f97316] no-underline font-medium hover:underline">
                        View Laravel Changelog
                    </a>
                </div>
                <div class="text-xs text-[#f1f2f6]">SLAVUSworks &copy; {{ date('Y') }}</div>
            </footer>
        </div>
    </body>
</html>