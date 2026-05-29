<div id="sidebar-overlay"
    class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

<aside id="sidebar"
    class="fixed top-0 left-0 z-50 lg:z-40 w-72 h-screen bg-sidebar border-r border-sidebar-border transform -translate-x-full lg:translate-x-0 transition-transform duration-300 overflow-y-auto">

    <div class="pt-20 px-4 pb-6">

        <!-- <div
            class="rounded-3xl border border-sidebar-border bg-surface-card p-5 shadow-glow mb-6">

            <div class="flex items-center gap-4">

                <div
                    class="w-14 h-14 rounded-2xl bg-accent-muted flex items-center justify-center text-accent text-2xl">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <div>
                    <h2 class="font-semibold text-white">
                        Administrator
                    </h2>

                    <p class="text-sm text-gray-400">
                        System Administrator
                    </p>
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