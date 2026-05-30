@extends('tl-manager.translation.layouts.app')

@section('title', 'Expedition Description List')

@section('search_route', route('expedition-descs.index'))

@section('content')

@include('tl-manager.translation.expedition-descs.partials.sidebar')

<link rel="stylesheet" href="{{ asset('css/translation/style-index.css') }}">
<div>
    <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-100">
                Expedition Descriptions
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage and monitor expedition description translations.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">

            {{-- FILTER --}}
            <form
                method="GET"
                action="{{ route('expedition-descs.index') }}"
                class="relative">

                <input
                    type="hidden"
                    name="search"
                    value="{{ request('search') }}">

                <select
                    name="status"
                    onchange="this.form.submit()"
                    class="h-10 min-w-[180px] appearance-none rounded-xl border border-surface-border bg-surface-card pl-4 pr-10 text-xs font-medium text-slate-300 transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-orange-500/10">
                    <option value="">All Statuses</option>
                    <option value="untranslated" @selected(request('status') == 'untranslated')>
                        Untranslated
                    </option>
                    <option value="translated" @selected(request('status') == 'translated')>
                        Translated
                    </option>
                    <option value="on-progress" @selected(request('status') == 'on-progress')>
                        On Progress
                    </option>
                </select>
                <svg
                    class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"/>
                </svg>
            </form>
            <a
                href="{{ route('expedition-descs.export') }}"
                class="inline-flex h-10 items-center gap-2 rounded-xl border border-surface-border bg-surface-card px-4 text-xs font-medium text-slate-300 transition hover:border-accent/40 hover:bg-sidebar-hover hover:text-white">
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Export
            </a>
            <a
                href="{{ route('expedition-descs.create') }}"
                class="inline-flex h-10 items-center gap-2 rounded-xl px-4 text-xs font-semibold text-white border-blue-700 bg-blue-600 text-white hover:bg-blue-700 hover:shadow-[0_0_0_3px_rgba(59,130,246,0.2)]">
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                New Expedition
            </a>
        </div>
    </div>
    <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.9rem] overflow-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b border-[#1e2436] bg-[#0f1117]">
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left sm:table-cell hidden">ID</th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left">Code</th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left">
                        Japanese Title <span class="text-slate-700">(Source)</span>
                    </th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left sm:table-cell hidden">
                        Translated Title <span class="text-slate-700">(Target)</span>
                    </th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left">Status</th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($expeditionDescs as $expeditionDesc)
                    <tr class="border-b border-[#1a1e2b] last:border-b-0 hover:bg-[#181c27] transition-colors duration-100">

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle sm:table-cell hidden">
                            <span class="text-slate-400 text-[0.78rem] font-medium">#{{ $expeditionDesc->expedition_desc_id ?? 'expedition_code' }}</span>
                        </td>

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle">
                            <span class="font-mono text-[0.75rem] font-bold text-orange-500 tracking-[0.03em]">
                                @if($expeditionDesc->expedition_desc_code == "")
                                    no_default_code
                                @else
                                    {{ $expeditionDesc->expedition_desc_code }}
                                @endif
                            </span>
                        </td>

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle">
                            <span class="text-[0.9rem] text-slate-200 max-w-[220px] block">{{ $expeditionDesc->title_jp }}</span>
                        </td>

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle sm:table-cell hidden">
                            <span class="text-slate-400 max-w-[220px] block">{{ $expeditionDesc->title_en }}</span>
                        </td>

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle">
                            @php
                                $status = $expeditionDesc->translationStatus?->status ?? 'untranslated';
                            @endphp
                            @if($status === 'translated')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[0.35rem] text-[0.65rem] font-bold tracking-[0.1em] uppercase whitespace-nowrap border bg-emerald-500/10 border-emerald-500/30 text-emerald-300">
                                    <span class="w-[5px] h-[5px] rounded-full bg-current"></span>
                                    Translated
                                </span>
                            @elseif($status === 'on-progress')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[0.35rem] text-[0.65rem] font-bold tracking-[0.1em] uppercase whitespace-nowrap border bg-yellow-500/10 border-yellow-500/30 text-yellow-300">
                                    <span class="w-[5px] h-[5px] rounded-full bg-current"></span>
                                    On Progress
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[0.35rem] text-[0.65rem] font-bold tracking-[0.1em] uppercase whitespace-nowrap border bg-red-500/10 border-red-500/30 text-red-300">
                                    <span class="w-[5px] h-[5px] rounded-full bg-current"></span>
                                    Untranslated
                                </span>
                            @endif
                        </td>
                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle">
                            <div class="flex items-center gap-1.5 justify-end">
                                <a href="{{ route('expedition-descs.edit', $expeditionDesc) }}"
                                   title="Edit expedition description"
                                   class="w-[30px] h-[30px] flex items-center justify-center rounded-[0.4rem] border border-[#252a38] bg-transparent text-slate-500 cursor-pointer no-underline transition-all duration-150 hover:bg-[#1e2436] hover:text-slate-200 hover:border-slate-500">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <form
                                    method="POST"
                                    action="{{ route('expedition-descs.destroy', $expeditionDesc) }}"
                                    onsubmit="return confirm('Delete expedition description #{{ $expeditionDesc->id }}?');"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Delete expedition description"
                                            class="w-[30px] h-[30px] flex items-center justify-center rounded-[0.4rem] border border-[#252a38] bg-transparent text-slate-500 cursor-pointer transition-all duration-150 hover:bg-red-500/10 hover:text-red-400 hover:border-red-500/30">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6M14 11v6"/>
                                            <path d="M9 6V4h6v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="text-center py-16 px-8 text-slate-600">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mx-auto mb-4 opacity-30">
                                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                </svg>
                                <h3 class="font-[Plus_Jakarta_Sans] text-[1.1rem] font-bold text-slate-500 mb-1.5">No expedition descriptions found</h3>
                                <p class="text-[0.82rem]">Try another keyword or <a href="{{ route('expedition-descs.create') }}" class="text-blue-500">create a new expedition description</a>.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="flex items-center justify-between px-[1.1rem] py-[0.85rem] border-t border-[#1e2436] bg-[#0f1117] flex-wrap gap-3">
            <span class="text-[0.75rem] text-slate-500">
                Showing {{ $expeditionDescs->firstItem() }}–{{ $expeditionDescs->lastItem() }} of
                <strong class="text-slate-400">{{ number_format($expeditionDescs->total()) }}</strong> expedition descriptions
            </span>
            {{ $expeditionDescs->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection