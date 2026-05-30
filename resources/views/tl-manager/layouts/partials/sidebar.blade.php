<div id="sidebar-overlay"
    class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

<aside id="sidebar"
    class="fixed top-0 left-0 z-40 lg:z-40 w-72 h-screen bg-sidebar border-r border-sidebar-border transform -translate-x-full lg:translate-x-0 transition-transform duration-300 overflow-y-auto">

    <div class="pt-20 px-4 pb-6">

        <!-- <div class="rounded-xl border border-sidebar-border bg-surface-card p-5 shadow-glow mb-6">
            <div class="flex items-center gap-4">
                @if(auth()->user()->profile_photo)
                    <img
                        src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                        alt="{{ auth()->user()->name }}"
                        class="w-14 h-14 rounded-2xl object-cover border border-sidebar-border">
                @else
                    <div
                        class="w-14 h-14 rounded-2xl bg-accent-muted flex items-center justify-center text-accent text-xl font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="min-w-0">
                    <h2 class="font-semibold text-white truncate">
                        {{ auth()->user()->name }}
                    </h2>
                    <p class="text-sm text-gray-400 truncate">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-sidebar-border">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-wider text-gray-500">
                        Role
                    </span>
                    <span
                        class="px-2.5 py-1 rounded-lg text-xs font-medium
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
                <div class="flex items-center justify-between mt-3">
                    <span class="text-xs uppercase tracking-wider text-gray-500">
                        Status
                    </span>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span class="text-xs text-emerald-300">
                            Online
                        </span>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="space-y-2 my-2">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-4 px-1 py-1 rounded-xl transition border border-transparent
                {{ request()->routeIs('admin.dashboard')
                    ? 'bg-sidebar-active border-sidebar-border text-white shadow-glow'
                    : 'hover:bg-sidebar-hover text-gray-300 hover:text-white' }}">

                <div class="w-10 h-10 rounded-xl bg-accent-muted flex items-center justify-center text-accent">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div>
                    <p class="font-medium">Dashboard</p>
                </div>
            </a>
        </div>
        <div class="space-y-2 my-2">
            <a href="{{ route('admin.modules') }}"
                class="flex items-center gap-4 px-1 py-1 rounded-xl transition border border-transparent
                {{ request()->routeIs('admin.modules')
                    ? 'bg-sidebar-active border-sidebar-border text-white shadow-glow'
                    : 'hover:bg-sidebar-hover text-gray-300 hover:text-white' }}">

                <div class="w-10 h-10 rounded-xl bg-accent-muted flex items-center justify-center text-accent">
                    <i class="fa-solid fa-book-atlas"></i>
                </div>
                <div>
                    <p class="font-medium">Modules</p>
                </div>
            </a>
        </div>
        @if(auth()->user()->role === 'admin')
            <div class="space-y-2 my-2">
                <a href="{{ route('users.index') }}"
                    class="flex items-center gap-4 px-1 py-1 rounded-xl transition border border-transparent
                    {{ request()->routeIs('users.*')
                        ? 'bg-sidebar-active border-sidebar-border text-white shadow-glow'
                        : 'hover:bg-sidebar-hover text-gray-300 hover:text-white' }}">

                    <div class="w-10 h-10 rounded-xl bg-accent-muted flex items-center justify-center text-accent">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <div>
                        <p class="font-medium">User Management</p>
                    </div>
                </a>
            </div>
        @endif
    </div>

</aside>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const toggle = document.getElementById('sidebar-toggle');

    toggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>