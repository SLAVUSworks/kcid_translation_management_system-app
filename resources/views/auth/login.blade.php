<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log in — {{ config('app.name', 'KCID TMS') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite('resources/css/app.css')

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

            .input-focus:focus {
                outline: none;
                border-color: rgba(249,115,22,0.5);
                box-shadow: 0 0 0 3px rgba(249,115,22,0.1);
            }

            .btn-glow:hover {
                box-shadow: 0 0 0 1px rgba(249,115,22,0.3), 0 4px 24px rgba(249,115,22,0.15);
            }

            .checkbox-accent:checked {
                background-color: #f97316;
                border-color: #f97316;
            }
            .checkbox-accent:focus {
                box-shadow: 0 0 0 3px rgba(249,115,22,0.2);
            }
        </style>
    </head>
    <body class="bg-[#13161f] text-[#f1f2f6] min-h-screen antialiased">
        <div class="fixed pointer-events-none z-0 rounded-full blur-[120px] w-[600px] h-[600px] -top-[200px] -right-[150px] bg-[rgba(249,115,22,0.07)]"></div>
        <div class="fixed pointer-events-none z-0 rounded-full blur-[120px] w-[400px] h-[400px] -bottom-[100px] -left-[100px] bg-[rgba(249,115,22,0.04)]"></div>
        <div class="relative z-[1] min-h-screen flex">
            <div class="hidden lg:flex flex-col justify-between w-[480px] shrink-0 bg-[#0f1117] border-r border-[#1e2436] p-10 relative overflow-hidden">
                <div class="absolute inset-0 pointer-events-none">
                    <img src="https://safebooru.org//samples/567/sample_2d57967d114c18f7d50e51752acb99ae68a53ad7.jpg?6653367"
                         alt=""
                         class="w-full h-full object-cover object-center opacity-[0.12]">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f1117] via-[#0f1117]/60 to-transparent"></div>
                </div>
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center gap-2.5 no-underline">
                        <img src="https://github.com/SLAVUSworks/KanColle-Indonesia-Patch-KCCP/blob/(dropped)-development/Non-Game%20Assets/banner.png?raw=true"
                             class="h-9 w-auto rounded-xl object-cover"
                             alt="KCID Logo">
                    </a>
                </div>
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-1.5 px-3 py-[5px] bg-[rgba(249,115,22,0.12)] border border-[rgba(249,115,22,0.2)] rounded-full text-[11px] font-medium text-[#f97316] mb-5 tracking-[0.01em]">
                        Translation Management System
                    </div>
                    <h2 class="text-3xl font-extrabold leading-[1.15] tracking-[-0.025em] text-[#f1f2f6] mb-3">
                        KanColle <span class="text-[#f97316]">Indonesia</span><br>Patch
                    </h2>
                    <p class="text-sm leading-relaxed text-[#8892a4] max-w-[320px]">
                        Platform manajemen terjemahan KanColle untuk JSON patch aset Bahasa Indonesia.
                    </p>
                </div>
                <div class="relative z-10 flex flex-col gap-2">
                    <a href="https://github.com/SLAVUSworks/KanColle-Indonesia-Patch-KCCP"
                       target="_blank"
                       class="flex items-center gap-2.5 text-[12px] text-[#4e5668] hover:text-[#8892a4] no-underline transition-colors duration-150">
                        <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 16 16" fill="currentColor">
                            <path d="M8 1.5C4.41 1.5 1.5 4.41 1.5 8c0 2.87 1.86 5.3 4.44 6.16.32.06.44-.14.44-.31v-1.09c-1.8.39-2.18-.87-2.18-.87-.29-.75-.72-.95-.72-.95-.59-.4.04-.4.04-.4.65.05 1 .67 1 .67.58 1 1.53.71 1.9.54.06-.42.23-.71.41-.87-1.44-.16-2.95-.72-2.95-3.2 0-.71.25-1.29.67-1.74-.07-.16-.29-.82.06-1.71 0 0 .55-.18 1.8.67.52-.14 1.08-.22 1.63-.22s1.11.08 1.63.22c1.25-.85 1.8-.67 1.8-.67.35.89.13 1.55.06 1.71.42.45.67 1.03.67 1.74 0 2.49-1.52 3.04-2.96 3.2.23.2.44.59.44 1.19v1.77c0 .17.12.37.44.31A6.502 6.502 0 0 0 14.5 8C14.5 4.41 11.59 1.5 8 1.5Z"/>
                        </svg>
                        SLAVUSworks / KanColle-Indonesia-Patch-KCCP
                    </a>
                    <span class="text-[11px] text-[#4e5668]">SLAVUSworks &copy; {{ date('Y') }}</span>
                </div>
            </div>
            <div class="flex-1 flex flex-col items-center justify-center px-6 py-12 lg:px-16">
                <div class="lg:hidden mb-8">
                    <a href="/" class="inline-flex items-center gap-2.5 no-underline">
                        <img src="https://github.com/SLAVUSworks/KanColle-Indonesia-Patch-KCCP/blob/(dropped)-development/Non-Game%20Assets/banner.png?raw=true"
                             class="h-9 w-auto rounded-xl object-cover"
                             alt="KCID Logo">
                    </a>
                </div>
                <div class="w-full max-w-[400px]">
                    <div class="mb-8">
                        <h1 class="text-2xl font-extrabold tracking-[-0.025em] text-[#f1f2f6] mb-1.5">
                            Welcome back
                        </h1>
                        <p class="text-sm text-[#8892a4]">
                            Sign in to your KCID TMS account
                        </p>
                    </div>
                    @if (session('status'))
                        <div class="mb-5 flex items-center gap-2.5 px-4 py-3 bg-[rgba(34,197,94,0.08)] border border-[rgba(34,197,94,0.2)] rounded-lg">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#4ade80] shrink-0"></span>
                            <p class="text-sm text-[#4ade80] font-medium">{{ session('status') }}</p>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                        @csrf
                        <div class="flex flex-col gap-1.5">
                            <label for="email" class="text-[13px] font-medium text-[#8892a4] tracking-[0.01em]">
                                Email address
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="you@example.com"
                                class="input-focus w-full px-3.5 py-2.5 bg-[#1a1d27] border border-[#252a38] rounded-[10px] text-sm text-[#f1f2f6] placeholder-[#4e5668] transition-all duration-150"
                            >
                            @error('email')
                                <p class="flex items-center gap-1.5 text-xs text-red-400 mt-0.5">
                                    <svg class="w-3 h-3 shrink-0" viewBox="0 0 12 12" fill="none">
                                        <circle cx="6" cy="6" r="5.5" stroke="currentColor" stroke-opacity="0.5"/>
                                        <path d="M6 4v2.5M6 8h.01" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <div class="flex items-center justify-between">
                                <label for="password" class="text-[13px] font-medium text-[#8892a4] tracking-[0.01em]">
                                    Password
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                       class="text-[12px] text-[#f97316] hover:text-[#ea6c0f] no-underline transition-colors duration-150 font-medium">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="input-focus w-full px-3.5 py-2.5 bg-[#1a1d27] border border-[#252a38] rounded-[10px] text-sm text-[#f1f2f6] placeholder-[#4e5668] transition-all duration-150"
                            >
                            @error('password')
                                <p class="flex items-center gap-1.5 text-xs text-red-400 mt-0.5">
                                    <svg class="w-3 h-3 shrink-0" viewBox="0 0 12 12" fill="none">
                                        <circle cx="6" cy="6" r="5.5" stroke="currentColor" stroke-opacity="0.5"/>
                                        <path d="M6 4v2.5M6 8h.01" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <label for="remember_me" class="flex items-center gap-2.5 cursor-pointer select-none">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="checkbox-accent w-4 h-4 rounded bg-[#1a1d27] border border-[#252a38] transition-all duration-150 cursor-pointer"
                            >
                            <span class="text-[13px] text-[#8892a4]">Remember me</span>
                        </label>
                        <button
                            type="submit"
                            class="btn-glow w-full flex items-center justify-center gap-2 px-6 py-2.5 bg-[#f97316] text-white text-sm font-semibold rounded-[10px] border-0 cursor-pointer transition-all duration-150 hover:bg-[#ea6c0f] hover:-translate-y-px active:translate-y-0 mt-1"
                        >
                            Sign in
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                    <div class="flex items-center gap-3 my-6">
                        <div class="flex-1 h-px bg-[#252a38]"></div>
                        <span class="text-[11px] text-[#4e5668] font-medium tracking-[0.05em] uppercase">or</span>
                        <div class="flex-1 h-px bg-[#252a38]"></div>
                    </div>
                    <a href="/"
                       class="w-full flex items-center justify-center gap-2 px-6 py-2.5 bg-[#181c27] text-[#8892a4] text-sm font-medium rounded-[10px] border border-[#252a38] no-underline transition-all duration-150 hover:border-[rgba(249,115,22,0.3)] hover:text-[#f1f2f6] hover:bg-[#1a1d27]">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M11.5 7H2.5M2.5 7L6.5 3M2.5 7L6.5 11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Back to homepage
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>