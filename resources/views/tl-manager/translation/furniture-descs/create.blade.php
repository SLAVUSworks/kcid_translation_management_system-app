@extends('tl-manager.translation.layouts.app')

@section('title', 'Create Furniture Description')

@section('content')

@include('tl-manager.translation.furniture-descs.partials.sidebar')

<form method="POST" action="{{ route('furniture-descs.store') }}">
    @csrf

    <div class="flex flex-col gap-6">
        <div class="flex items-end justify-between flex-wrap gap-4">
            <div>
                <a href="{{ route('furniture-descs.index') }}"
                   class="inline-flex items-center gap-1.5 text-[0.8rem] font-medium text-slate-500 no-underline transition-colors duration-150 hover:text-slate-200">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                    </svg>
                    Back to Furniture Descriptions
                </a>
                <h1 class="text-slate-100 tracking-tight leading-tight mt-1.5">Create Furniture Description</h1>
                <p class="text-[0.8rem] text-slate-500 mt-0.5">Add a new translation entry to the localization hub.</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('furniture-descs.index') }}"
                   class="inline-flex items-center gap-1.5 px-[1.1rem] py-2 rounded-[0.55rem] text-[0.8rem] font-semibold cursor-pointer no-underline transition-all duration-150 border border-[#252a38] bg-[#181c27] text-slate-400 hover:bg-[#1e2436] hover:text-slate-200 whitespace-nowrap font-[Plus_Jakarta_Sans]">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-[1.1rem] py-2 rounded-[0.55rem] text-[0.8rem] font-semibold cursor-pointer transition-all duration-150 border border-blue-700 bg-blue-600 text-white hover:bg-blue-700 hover:shadow-[0_0_0_3px_rgba(59,130,246,0.2)] whitespace-nowrap font-[Plus_Jakarta_Sans]">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Create Furniture Description
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-[360px_1fr] gap-5 items-start">
            <div class="flex flex-col gap-4">
                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-[0.7rem] border-b border-[#1e2436] bg-[#0f1117]">
                        <svg class="text-blue-500 opacity-80 shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="16" x2="12" y2="12"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                        </svg>
                        <span class="text-[0.78rem] font-bold text-slate-400 tracking-[0.04em]">Furniture Description Details</span>
                    </div>

                    <div class="p-[1.1rem] flex flex-col gap-[0.9rem]">
                        <div>
                            <label class="block text-[0.7rem] font-bold tracking-[0.08em] uppercase text-slate-500 mb-[0.35rem]">Furniture Description ID</label>
                            <input
                                type="number"
                                name="furniture_desc_id"
                                value="{{ old('furniture_desc_id') }}"
                                placeholder="e.g. 101"
                                required
                                class="w-full px-[0.8rem] py-[0.55rem] bg-[#0f1117] border border-[#252a38] rounded-lg text-[0.82rem] text-slate-200 outline-none font-[Plus_Jakarta_Sans] transition-all duration-150 placeholder-[#334155] focus:border-blue-500 focus:bg-[#181c27]"
                            >
                            @error('furniture_desc_id')
                                <p class="text-[0.72rem] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[0.7rem] font-bold tracking-[0.08em] uppercase text-slate-500 mb-[0.35rem]">Furniture Description Code (Nullable)</label>
                            <input
                                type="text"
                                name="furniture_desc_code"
                                value="{{ old('furniture_desc_code') }}"
                                placeholder="_furniture_desc_code_A1"
                                class="w-full px-[0.8rem] py-[0.55rem] bg-[#0f1117] border border-[#252a38] rounded-lg text-[0.8rem] text-slate-200 outline-none font-mono transition-all duration-150 placeholder-[#334155] focus:border-blue-500 focus:bg-[#181c27]"
                            >
                            @error('furniture_desc_code')
                                <p class="text-[0.72rem] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-[0.7rem] border-b border-[#1e2436] bg-[#0f1117]">
                        <svg class="text-blue-500 opacity-80 shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                        <span class="text-[0.78rem] font-bold text-slate-400 tracking-[0.04em]">Localization Targets</span>
                    </div>

                    <div class="p-[1.1rem] flex flex-col gap-[0.9rem]">
                        <div class="flex items-center justify-between px-[0.85rem] py-[0.6rem] bg-[#0f1117] border border-[#1e2436] rounded-lg text-[0.8rem] text-slate-400">
                            <div class="flex items-center gap-2">
                                <span class="w-[7px] h-[7px] rounded-full bg-blue-500 shrink-0"></span>
                                Source: Japanese (JP)
                            </div>
                            <svg class="text-slate-600 shrink-0" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>

                        <div class="flex items-center justify-between px-[0.85rem] py-[0.6rem] bg-[#0f1117] border border-[#1e2436] rounded-lg text-[0.8rem] text-slate-400">
                            <div class="flex items-center gap-2">
                                <span class="w-[7px] h-[7px] rounded-full bg-orange-500 shrink-0"></span>
                                Target: Translated
                            </div>
                            <svg class="text-slate-600 shrink-0" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] p-4 flex flex-col gap-2">
                    <div class="flex items-start gap-2 text-[0.75rem] text-slate-600 leading-relaxed">
                        <svg class="shrink-0 mt-[1px] text-slate-700" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                            <line x1="12" y1="12" x2="12" y2="16"/>
                        </svg>
                        Furniture Description ID controls ordering in exports
                    </div>
                    <div class="flex items-start gap-2 text-[0.75rem] text-slate-600 leading-relaxed">
                        <svg class="shrink-0 mt-[1px] text-slate-700" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                            <line x1="12" y1="12" x2="12" y2="16"/>
                        </svg>
                        Quest Code must be unique (e.g. _quest_code_A1)
                    </div>
                    <div class="flex items-start gap-2 text-[0.75rem] text-slate-600 leading-relaxed">
                        <svg class="shrink-0 mt-[1px] text-slate-700" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                            <line x1="12" y1="12" x2="12" y2="16"/>
                        </svg>
                        Descriptions are optional but recommended
                    </div>
                </div>

            </div>

            <div class="flex flex-col gap-4">

                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-[0.6rem] border-b border-[#1e2436] bg-[#0f1117]">
                        <span class="text-[0.65rem] font-bold tracking-[0.15em] uppercase text-slate-600">Titles</span>
                        <span class="text-[0.65rem] text-slate-700 italic">99 Characters</span>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="border-r border-[#1e2436]">
                            <div class="flex items-center gap-1.5 px-4 py-[0.45rem] border-b border-[#1a1e2b] text-[0.65rem] font-bold tracking-[0.1em] uppercase text-slate-500">
                                <span class="w-[5px] h-[5px] rounded-full bg-blue-500 shrink-0"></span>
                                Japanese
                            </div>
                            <textarea
                                name="title_jp"
                                rows="4"
                                placeholder="日本語タイトル..."
                                required
                                class="w-full px-4 py-[0.85rem] bg-transparent border-none outline-none resize-none text-[0.85rem] text-slate-200 font-[Plus_Jakarta_Sans] leading-[1.65] min-h-[182px] transition-colors duration-150 placeholder-[#2d3a4f] focus:bg-blue-500/[0.03]"
                            >{{ old('title_jp') }}</textarea>
                            @error('title_jp')
                                <p class="text-[0.72rem] text-red-400 px-4 pb-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex items-center gap-1.5 px-4 py-[0.45rem] border-b border-[#1a1e2b] text-[0.65rem] font-bold tracking-[0.1em] uppercase text-orange-700">
                                <span class="w-[5px] h-[5px] rounded-full bg-orange-500 shrink-0"></span>
                                Translated
                            </div>
                            <textarea
                                name="title_en"
                                rows="4"
                                placeholder="Translated title..."
                                required
                                class="w-full px-4 py-[0.85rem] bg-transparent border-none outline-none resize-none text-[0.85rem] text-orange-500 italic font-[Plus_Jakarta_Sans] leading-[1.65] min-h-[182px] transition-colors duration-150 placeholder-[#2d3a4f] focus:bg-blue-500/[0.03]"
                            >{{ old('title_en') }}</textarea>
                            @error('title_en')
                                <p class="text-[0.72rem] text-red-400 px-4 pb-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-[0.6rem] border-b border-[#1e2436] bg-[#0f1117]">
                        <span class="text-[0.65rem] font-bold tracking-[0.15em] uppercase text-slate-600">Description</span>
                        <span class="text-[0.65rem] text-slate-700 italic">Optional</span>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="border-r border-[#1e2436]">
                            <div class="flex items-center gap-1.5 px-4 py-[0.45rem] border-b border-[#1a1e2b] text-[0.65rem] font-bold tracking-[0.1em] uppercase text-slate-500">
                                <span class="w-[5px] h-[5px] rounded-full bg-blue-500 shrink-0"></span>
                                Japanese
                            </div>
                            <textarea
                                name="description_jp"
                                rows="5"
                                placeholder="日本語説明（任意）..."
                                class="w-full px-4 py-[0.85rem] bg-transparent border-none outline-none resize-none text-[0.85rem] text-slate-200 font-[Plus_Jakarta_Sans] leading-[1.65] min-h-[182px] transition-colors duration-150 placeholder-[#2d3a4f] focus:bg-blue-500/[0.03]"
                            >{{ old('description_jp') }}</textarea>
                        </div>

                        <div>
                            <div class="flex items-center gap-1.5 px-4 py-[0.45rem] border-b border-[#1a1e2b] text-[0.65rem] font-bold tracking-[0.1em] uppercase text-orange-700">
                                <span class="w-[5px] h-[5px] rounded-full bg-orange-500 shrink-0"></span>
                                Translated
                            </div>
                            <textarea
                                name="description_en"
                                rows="5"
                                placeholder="Translated description (optional)..."
                                class="w-full px-4 py-[0.85rem] bg-transparent border-none outline-none resize-none text-[0.85rem] text-orange-500 italic font-[Plus_Jakarta_Sans] leading-[1.65] min-h-[182px] transition-colors duration-150 placeholder-[#2d3a4f] focus:bg-blue-500/[0.03]"
                            >{{ old('description_en') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</form>

@endsection