<nav class="fixed top-0 left-0 right-0 z-50 h-16 border-b border-sidebar-border bg-sidebar/95 backdrop-blur-xl">

    <div class="h-full px-4 md:px-6 flex items-center justify-between">

        <div class="flex items-center gap-4">

            <button id="sidebar-toggle"
                class="lg:hidden w-10 h-10 rounded-xl bg-sidebar-hover border border-sidebar-border text-gray-300">
                <i class="fa-solid fa-bars"></i>
            </button>

            <a href="#" class="flex items-center gap-4">

                <div
                    class="w-fit h-11 rounded-xl flex items-center justify-center">

                    <img src="https://github.com/SLAVUSworks/KanColle-Indonesia-Patch-KCCP/blob/(dropped)-development/Non-Game%20Assets/banner.png?raw=true"
                        class="w-full h-9 rounded-xl object-cover">

                </div>

                <div>
                    <h1 class="text-sm md:text-base font-bold text-white leading-tight">
                        KCID_TMS-APP
                    </h1>

                    <p class="text-xs text-gray-400">
                        Web Control Panel
                    </p>
                </div>

            </a>

        </div>

        <div class="flex items-center gap-3">

            <button
                class="relative w-11 h-11 rounded-xl bg-sidebar-hover border border-sidebar-border text-gray-300 hover:text-accent transition">

                <i class="fa-solid fa-bell"></i>

                <span
                    class="absolute top-2 right-2 w-2 h-2 rounded-full bg-accent"></span>
            </button>

            <div
                x-data="{ open: false }"
                class="relative flex items-center gap-3 pl-3 border-l border-sidebar-border">

                <button
                    @click="open = !open"
                    class="flex items-center gap-3 focus:outline-none">

                    <div class="hidden sm:block text-right">

                        <p class="text-sm font-medium text-white">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-400 capitalize">
                            {{ auth()->user()->role }}
                        </p>

                    </div>

                    @if(auth()->user()->profile_photo)

                        <img
                            src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                            alt="{{ auth()->user()->name }}"
                            class="w-11 h-11 rounded-xl object-cover border border-sidebar-border shadow-glow">

                    @else

                        <div class="w-11 h-11 rounded-xl border border-sidebar-border bg-orange-500/10 flex items-center justify-center text-sm font-bold text-orange-300 shadow-glow">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                    @endif

                </button>

                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 top-14 w-64 rounded-2xl border border-sidebar-border bg-[#181c27] shadow-2xl overflow-hidden z-50">

                    <div class="p-4 border-b border-sidebar-border">

                        <p class="font-semibold text-white">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-gray-400 truncate">
                            {{ auth()->user()->email }}
                        </p>

                        <span class="inline-flex mt-3 px-2.5 py-1 rounded-lg text-xs font-medium
                            @if(auth()->user()->role === 'admin')
                                bg-red-500/10 text-red-300 border border-red-500/20
                            @elseif(auth()->user()->role === 'verified')
                                bg-emerald-500/10 text-emerald-300 border border-emerald-500/20
                            @else
                                bg-yellow-500/10 text-yellow-300 border border-yellow-500/20
                            @endif">

                            {{ ucfirst(auth()->user()->role) }}

                        </span>

                    </div>

                    <div class="p-2">

                        <a
                            href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:bg-surface-secondary hover:text-white transition">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            Profile Settings

                        </a>

                        <form
                            method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <button
                                type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-300 hover:bg-red-500/10 transition">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H9m4 8H7a2 2 0 01-2-2V6a2 2 0 012-2h6" />
                                </svg>

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</nav>