@extends('tl-manager.layouts.app')

@section('title', 'Dashboard')

@section('content')

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    sidebar: {
                        DEFAULT: '#0f1117',
                        hover: '#1a1d27',
                        active: '#1e2130',
                        border: '#1e2436',
                    },
                    accent: {
                        DEFAULT: '#f97316',
                        muted: 'rgba(249,115,22,0.12)',
                    },
                    surface: {
                        DEFAULT: '#13161f',
                        card: '#181c27',
                        border: '#252a38',
                    },
                },
                boxShadow: {
                    glow: '0 0 0 1px rgba(249,115,22,0.3), 0 4px 24px rgba(249,115,22,0.08)',
                },
            }
        }
    }
</script>

<div class="space-y-8">

    {{-- Header --}}
    <div
        class="relative overflow-hidden rounded-3xl border border-surface-border bg-surface-card p-8 shadow-glow">

        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(249,115,22,0.15),transparent_35%)]">
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>
                <p class="text-accent text-sm font-semibold tracking-widest uppercase">
                    KanColle Patch Indonesia
                </p>

                <h1 class="text-3xl md:text-4xl font-bold text-white mt-2">
                    Dashboard
                </h1>

                <p class="text-gray-400 mt-3 max-w-2xl">
                    Manage KanColle translation assets, localization strings, and content workflow.
                </p>
            </div>

            <div
                class="flex items-center gap-4 bg-sidebar-active border border-sidebar-border rounded-2xl px-5 py-4">

                <div
                    class="w-14 h-14 rounded-2xl bg-accent-muted flex items-center justify-center text-accent text-2xl">
                    <i class="fa-solid fa-language"></i>
                </div>

                <div>
                    <p class="text-sm text-gray-400">
                        Active Modules
                    </p>

                    <h2 class="text-3xl font-bold text-white">
                        {{ count($menus) }}
                    </h2>
                </div>

            </div>

        </div>

    </div>

    {{-- Modules --}}
    <div>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-white">
                    Translation Modules
                </h2>

                <p class="text-gray-400 mt-1">
                    Dynamic modules loaded from translation controllers.
                </p>
            </div>
        </div>

        <div
            class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">

            @foreach ($menus as $menu)

            <a href="{{ route($menu['route']) }}"
                class="group relative overflow-hidden rounded-3xl border border-surface-border bg-surface-card p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-glow">

                {{-- Glow --}}
                <div
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition bg-[radial-gradient(circle_at_top_right,rgba(249,115,22,0.12),transparent_40%)]">
                </div>

                <div class="relative z-10">

                    <div class="flex items-start justify-between">

                        <div
                            class="w-14 h-14 rounded-2xl bg-accent-muted flex items-center justify-center text-accent text-2xl">

                            <i class="{{ $menu['icon'] }}"></i>

                        </div>

                        <div
                            class="w-10 h-10 rounded-xl bg-sidebar-hover flex items-center justify-center text-gray-400 group-hover:text-accent transition">

                            <i class="fa-solid fa-arrow-up-right-from-square text-sm"></i>

                        </div>

                    </div>

                    <div class="mt-6">

                        <h3
                            class="text-xl font-semibold text-white group-hover:text-accent transition">
                            {{ $menu['title'] }}
                        </h3>

                        <p class="text-sm text-gray-400 mt-2 leading-relaxed">
                            {{ $menu['description'] }}
                        </p>

                    </div>

                    <div
                        class="mt-6 pt-5 border-t border-surface-border flex items-center justify-between">

                        <span
                            class="text-xs uppercase tracking-widest text-gray-500">
                            Translation Module
                        </span>

                        <span
                            class="text-accent text-sm font-semibold group-hover:translate-x-1 transition">
                            Open →
                        </span>

                    </div>

                </div>

            </a>

            @endforeach

        </div>

    </div>

</div>

<style>
    body {
        background:
            radial-gradient(circle at top left,
                rgba(249, 115, 22, 0.08),
                transparent 25%),
            #13161f;
    }

    main {
        background: transparent !important;
    }
</style>

@endsection