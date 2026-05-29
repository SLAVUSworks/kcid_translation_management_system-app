@extends('tl-manager.translation.layouts.app')

@section('title', 'Item List')

@section('search_route', route('items.index'))

@section('content')

@include('tl-manager.translation.items.partials.sidebar')

<link rel="stylesheet" href="{{ asset('css/translation/style-index.css') }}">
<div>
    <div class="flex items-end justify-between gap-4 mb-7 flex-wrap">
        <div>
            <h1 class="text-slate-100 tracking-tight leading-tight">Item List</h1>
            <p class="text-xs text-slate-500 mt-0.5">Manage and monitor ongoing translation items.</p>
        </div>

        <div class="flex gap-2 items-center">
            <a href="{{ route('items.export') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-[0.55rem] text-xs font-semibold cursor-pointer no-underline transition-all duration-150 border border-[#252a38] bg-[#181c27] text-slate-400 hover:bg-[#1e2436] hover:text-slate-200 whitespace-nowrap font-[Plus_Jakarta_Sans]">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Export
            </a>

            <a href="{{ route('items.create') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-[0.55rem] text-xs font-semibold cursor-pointer no-underline transition-all duration-150 border border-blue-700 bg-blue-600 text-white hover:bg-blue-700 hover:shadow-[0_0_0_3px_rgba(59,130,246,0.2)] whitespace-nowrap font-[Plus_Jakarta_Sans]">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                New Item
            </a>
        </div>
    </div>

    <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.9rem] overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b border-[#1e2436] bg-[#0f1117]">
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left sm:table-cell hidden">ID</th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left sm:table-cell hidden">Code</th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left">
                        Japanese Title <span class="text-slate-700">(Source)</span>
                    </th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left">
                        Translated Title <span class="text-slate-700">(Target)</span>
                    </th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-left sm:table-cell hidden">Status</th>
                    <th class="px-[1.1rem] py-3 text-[0.68rem] font-bold tracking-[0.1em] uppercase text-slate-600 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($items as $item)
                    <tr class="border-b border-[#1a1e2b] last:border-b-0 hover:bg-[#181c27] transition-colors duration-100">

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle sm:table-cell hidden">
                            <span class="text-slate-400 text-[0.78rem] font-medium">#{{ $item->item_id }}</span>
                        </td>

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle sm:table-cell hidden">
                            <span class="font-mono text-[0.75rem] font-bold text-orange-500 tracking-[0.03em]">{{ $item->item_code }}</span>
                        </td>

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle">
                            <span class="text-[0.9rem] text-slate-200 max-w-[220px] block">{{ $item->title_jp }}</span>
                        </td>

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle">
                            <span class="text-slate-400 max-w-[220px] block">{{ $item->title_en }}</span>
                        </td>

                        <td class="px-[1.1rem] py-4 text-[0.83rem] text-slate-400 align-middle sm:table-cell hidden">
                            @php
                                $status = $item->translationStatus?->status ?? 'untranslated';
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

                                <a href="{{ route('items.edit', $item) }}"
                                   title="Edit item"
                                   class="w-[30px] h-[30px] flex items-center justify-center rounded-[0.4rem] border border-[#252a38] bg-transparent text-slate-500 cursor-pointer no-underline transition-all duration-150 hover:bg-[#1e2436] hover:text-slate-200 hover:border-slate-500">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('items.destroy', $item) }}"
                                    onsubmit="return confirm('Delete item #{{ $item->id }}?');"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Delete item"
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
                                <h3 class="font-[Plus_Jakarta_Sans] text-[1.1rem] font-bold text-slate-500 mb-1.5">No items found</h3>
                                <p class="text-[0.82rem]">Try another keyword or <a href="{{ route('items.create') }}" class="text-blue-500">create a new item</a>.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="flex items-center justify-between px-[1.1rem] py-[0.85rem] border-t border-[#1e2436] bg-[#0f1117] flex-wrap gap-3">
            <span class="text-[0.75rem] text-slate-500">
                Showing {{ $items->firstItem() }}–{{ $items->lastItem() }} of
                <strong class="text-slate-400">{{ number_format($items->total()) }}</strong> items
            </span>

            {{ $items->links() }}
        </div>

    </div>

</div>
@endsection