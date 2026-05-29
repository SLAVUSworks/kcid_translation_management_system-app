@extends('tl-manager.layouts.app')

@section('title', 'Translation Dashboard')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div
        class="relative overflow-hidden rounded-xl border border-surface-border bg-surface-card p-8 shadow-glow">

        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(249,115,22,0.15),transparent_35%)]">
        </div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>
                <p class="text-accent text-sm font-semibold tracking-widest uppercase">
                    KanColle Patch Indonesia
                </p>

                <h1 class="text-3xl md:text-4xl font-bold text-white mt-2">
                    Translation Dashboard
                </h1>

                <p class="text-gray-400 mt-3 max-w-2xl">
                    Monitor all translation modules and localization progress.
                </p>
            </div>

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-orange-500/20 bg-orange-500/10 text-orange-300 text-sm font-semibold">
                {{ $overallCompletion }}% Completed
            </div>

        </div>

    </div>

    {{-- GLOBAL STATS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-[#13161f] border border-[#1e2436] rounded-xl p-5">

            <p class="text-[0.7rem] font-bold uppercase tracking-[0.15em] text-slate-500">
                Total Assets
            </p>

            <h2 class="text-3xl font-bold text-slate-100 mt-2">
                {{ number_format($totalAssets) }}
            </h2>

        </div>

        <div class="bg-[#13161f] border border-emerald-500/20 rounded-xl p-5">

            <p class="text-[0.7rem] font-bold uppercase tracking-[0.15em] text-emerald-400">
                Translated
            </p>

            <h2 class="text-3xl font-bold text-emerald-300 mt-2">
                {{ number_format($totalTranslated) }}
            </h2>

        </div>

        <div class="bg-[#13161f] border border-orange-500/20 rounded-xl p-5">

            <p class="text-[0.7rem] font-bold uppercase tracking-[0.15em] text-orange-400">
                On Progress
            </p>

            <h2 class="text-3xl font-bold text-orange-300 mt-2">
                {{ number_format($totalOnProgress) }}
            </h2>

        </div>

        <div class="bg-[#13161f] border border-red-500/20 rounded-xl p-5">

            <p class="text-[0.7rem] font-bold uppercase tracking-[0.15em] text-red-400">
                Untranslated
            </p>

            <h2 class="text-3xl font-bold text-red-300 mt-2">
                {{ number_format($totalUntranslated) }}
            </h2>

        </div>

    </div>

    {{-- MODULES --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

        @foreach($menus as $menu)

            <div class="bg-[#13161f] border border-[#1e2436] rounded-xl overflow-hidden">

                {{-- TOP --}}
                <div class="flex items-center justify-between px-5 py-4 border-b border-[#1e2436] bg-[#0f1117]">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl border border-orange-500/20 bg-orange-500/10 flex items-center justify-center text-orange-400 text-lg">
                            <i class="{{ $menu['icon'] }}"></i>
                        </div>

                        <div>

                            <h2 class="text-sm font-semibold text-slate-100">
                                {{ $menu['description'] }}
                            </h2>

                            <p class="text-xs text-slate-500 mt-0.5">
                                {{ $menu['title'] }}
                            </p>

                        </div>

                    </div>

                    <!-- <a
                        href="{{ route($menu['route']) }}"
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg border border-[#252a38] bg-[#181c27] text-slate-400 text-xs font-semibold no-underline transition-all duration-150 hover:bg-[#1e2436] hover:text-slate-200"
                    >
                        Open
                    </a> -->

                </div>

                {{-- BODY --}}
                <div class="p-5 flex flex-col gap-5">

                    {{-- PROGRESS --}}
                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <span class="text-xs text-slate-500">
                                Completion
                            </span>

                            <span class="text-xs font-semibold text-orange-300">
                                {{ $menu['completion'] }}%
                            </span>

                        </div>

                        <div class="w-full h-2 rounded-full bg-[#0f1117] overflow-hidden">

                            <div
                                class="h-full bg-orange-500 rounded-full"
                                style="width: {{ $menu['completion'] }}%">
                            </div>

                        </div>

                    </div>

                    {{-- STATS --}}
                    <div class="grid grid-cols-3 gap-3">

                        <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/5 p-3">

                            <p class="text-[0.62rem] font-bold uppercase tracking-[0.12em] text-emerald-400">
                                Translated
                            </p>

                            <h3 class="text-xl font-bold text-emerald-300 mt-1">
                                {{ $menu['translated'] }}
                            </h3>

                        </div>

                        <div class="rounded-xl border border-orange-500/20 bg-orange-500/5 p-3">

                            <p class="text-[0.62rem] font-bold uppercase tracking-[0.12em] text-orange-400">
                                Progress
                            </p>

                            <h3 class="text-xl font-bold text-orange-300 mt-1">
                                {{ $menu['on_progress'] }}
                            </h3>

                        </div>

                        <div class="rounded-xl border border-red-500/20 bg-red-500/5 p-3">

                            <p class="text-[0.62rem] font-bold uppercase tracking-[0.12em] text-red-400">
                                Untranslated
                            </p>

                            <h3 class="text-xl font-bold text-red-300 mt-1">
                                {{ $menu['untranslated'] }}
                            </h3>

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="flex items-center justify-between pt-2 border-t border-[#1e2436]">

                        <span class="text-xs text-slate-500">
                            Total Assets
                        </span>

                        <span class="text-sm font-semibold text-slate-200">
                            {{ number_format($menu['assets']) }}
                        </span>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection

