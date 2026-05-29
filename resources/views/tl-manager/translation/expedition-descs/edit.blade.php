@extends('tl-manager.translation.layouts.app')

@section('title', 'Edit Expedition Description #' . $expeditionDesc->expedition_desc_id)

@section('content')

@include('tl-manager.translation.expedition-descs.partials.sidebar')

<form
    id="expedition-desc-form"
    method="POST"
    action="{{ route('expedition-descs.update', $expeditionDesc) }}"
>
    @csrf
    @method('PUT')

    <div class="flex flex-col gap-6">

        <div class="flex items-center justify-between flex-wrap gap-4">

            <div>
                <a href="{{ route('expedition-descs.index') }}"
                   class="inline-flex items-center gap-1.5 text-[0.8rem] font-medium text-slate-500 no-underline transition-colors duration-150 hover:text-slate-200">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                    </svg>
                    Back to Expedition Descriptions
                </a>
                <h1 class="text-slate-100 tracking-tight leading-tight mt-1.5">Edit Expedition Description</h1>
                <p class="text-[0.8rem] text-slate-500 mt-[0.25rem]">
                    Update localization strings for
                    <span class="text-orange-500 font-semibold">"{{ $expeditionDesc->expedition_desc_id }}"</span>
                </p>
            </div>

            <div class="flex items-center gap-2">

                <button
                    type="submit"
                    form="delete-form"
                    onclick="return confirm('Are you sure you want to delete this data? This action cannot be undone.')"
                    class="inline-flex items-center gap-1.5 px-[1.1rem] py-2 rounded-[0.55rem] text-[0.8rem] font-semibold cursor-pointer transition-all duration-150 border border-red-500/25 bg-red-500/10 text-red-400 hover:bg-red-500/[0.18] whitespace-nowrap font-[Plus_Jakarta_Sans]"
                >
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6M9 6V4h6v2"/>
                    </svg>

                    Delete
                </button>

                <a href="{{ route('expedition-descs.index') }}"
                   class="inline-flex items-center gap-1.5 px-[1.1rem] py-2 rounded-[0.55rem] text-[0.8rem] font-semibold cursor-pointer no-underline transition-all duration-150 border border-[#252a38] bg-[#181c27] text-slate-400 hover:bg-[#1e2436] hover:text-slate-200 whitespace-nowrap font-[Plus_Jakarta_Sans]">
                    Cancel
                </a>

                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-[1.1rem] py-2 rounded-[0.55rem] text-[0.8rem] font-semibold cursor-pointer transition-all duration-150 border border-blue-700 bg-blue-600 text-white hover:bg-blue-700 hover:shadow-[0_0_0_3px_rgba(59,130,246,0.2)] whitespace-nowrap font-[Plus_Jakarta_Sans]">
                    Save Changes
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
                        <span class="text-[0.78rem] font-bold text-slate-400 tracking-[0.04em]">Expedition Description Details</span>
                    </div>

                    <div class="p-[1.1rem] flex flex-col gap-[0.9rem]">

                        <div>
                            <label class="block text-[0.7rem] font-bold tracking-[0.08em] uppercase text-slate-500 mb-[0.35rem]">Expedition Description ID (Not Fillable)</label>
                            <input
                                type="number"
                                name="expedition_desc_id"
                                value="{{ old('expedition_desc_id', $expeditionDesc->expedition_desc_id) }}"
                                placeholder="expedition_code"
                                disabled
                                readonly
                                class="w-full px-[0.8rem] py-[0.55rem] bg-[#0f1117] border border-[#252a38] rounded-lg text-[0.82rem] text-slate-200 outline-none font-[Plus_Jakarta_Sans] transition-all duration-150 placeholder-[#334155] focus:border-blue-500 focus:bg-[#181c27]"
                            >
                            @error('expedition_desc_id')
                                <p class="text-[0.72rem] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[0.7rem] font-bold tracking-[0.08em] uppercase text-slate-500 mb-[0.35rem]">Expedition Description Code (Nullable)</label>
                            <input
                                type="text"
                                name="expedition_desc_code"
                                value="{{ old('expedition_desc_code', $expeditionDesc->expedition_desc_code) }}"
                                placeholder="leave this blank!"
                                class="w-full px-[0.8rem] py-[0.55rem] bg-[#0f1117] border border-[#252a38] rounded-lg text-[0.8rem] text-slate-200 outline-none font-mono transition-all duration-150 placeholder-[#334155] focus:border-blue-500 focus:bg-[#181c27]"
                            >
                            @error('expedition_desc_code')
                                <p class="text-[0.72rem] text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-[0.7rem] border-b border-[#1e2436] bg-[#0f1117]">
                        <svg class="text-orange-500 opacity-80 shrink-0"
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                        <span class="text-[0.78rem] font-bold text-slate-400 tracking-[0.04em]">
                            Translation Status
                        </span>
                    </div>
                    <div class="p-[1.1rem]">
                        <label class="block text-[0.7rem] font-bold tracking-[0.08em] uppercase text-slate-500 mb-[0.45rem]">
                            Current Status
                        </label>
                        <select
                            name="status"
                            class="w-full px-[0.8rem] py-[0.6rem] bg-[#0f1117] border border-[#252a38] rounded-lg text-[0.82rem] text-slate-200 outline-none font-[Plus_Jakarta_Sans] transition-all duration-150 focus:border-orange-500 focus:bg-[#181c27]">
                            <option
                                value="untranslated"
                                {{ old('status', $expeditionDesc->translationStatus?->status ?? 'untranslated') === 'untranslated' ? 'selected' : '' }}>
                                Untranslated
                            </option>
                            <option
                                value="on-progress"
                                {{ old('status', $expeditionDesc->translationStatus?->status ?? '') === 'on-progress' ? 'selected' : '' }}>
                                On Progress
                            </option>
                            <option
                                value="translated"
                                {{ old('status', $expeditionDesc->translationStatus?->status ?? '') === 'translated' ? 'selected' : '' }}>
                                Translated
                            </option>
                        </select>
                        @error('status')
                            <p class="text-[0.72rem] text-red-400 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
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

            </div>

            <div class="flex flex-col gap-4">
                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-[0.6rem] border-b border-[#1e2436] bg-[#0f1117]">
                        <span class="text-[0.65rem] font-bold tracking-[0.15em] uppercase text-slate-600">Titles</span>
                        <span class="text-[0.65rem] text-slate-700 italic">99 Characters</span>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="border-r border-[#1e2436]">
                            <textarea
                                name="title_jp"
                                rows="4"
                                placeholder="日本語タイトル..."
                                required
                                class="w-full p-4 bg-transparent border-none outline-none resize-none text-[0.85rem] text-slate-300 font-[Plus_Jakarta_Sans] leading-[1.65] min-h-[135px] transition-colors duration-150 placeholder-[#2d3a4f] focus:bg-blue-500/[0.03]"
                            >{{ old('title_jp', $expeditionDesc->title_jp) }}</textarea>
                            @error('title_jp')
                                <p class="text-[0.72rem] text-red-400 px-4 pb-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <textarea
                                name="title_en"
                                rows="4"
                                placeholder="Translated title..."
                                required
                                class="w-full p-4 bg-transparent border-none outline-none resize-none text-[0.85rem] text-orange-500 italic font-[Plus_Jakarta_Sans] leading-[1.65] min-h-[135px] transition-colors duration-150 placeholder-[#2d3a4f] focus:bg-blue-500/[0.03]"
                            >{{ old('title_en', $expeditionDesc->title_en) }}</textarea>
                            @error('title_en')
                                <p class="text-[0.72rem] text-red-400 px-4 pb-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-[0.6rem] border-b border-[#1e2436] bg-[#0f1117]">
                        <span class="text-[0.65rem] font-bold tracking-[0.15em] uppercase text-slate-600">Descriptions</span>
                        <span class="text-[0.65rem] text-slate-700 italic">99 Characters</span>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="border-r border-[#1e2436]">
                            <textarea
                                name="description_jp"
                                rows="4"
                                placeholder="日本語タイトル..."
                                required
                                class="w-full p-4 bg-transparent border-none outline-none resize-none text-[0.85rem] text-slate-300 font-[Plus_Jakarta_Sans] leading-[1.65] min-h-[135px] transition-colors duration-150 placeholder-[#2d3a4f] focus:bg-blue-500/[0.03]"
                            >{{ old('description_jp', $expeditionDesc->description_jp) }}</textarea>
                            @error('description_jp')
                                <p class="text-[0.72rem] text-red-400 px-4 pb-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <textarea
                                name="description_en"
                                rows="4"
                                placeholder="Translated description..."
                                required
                                class="w-full p-4 bg-transparent border-none outline-none resize-none text-[0.85rem] text-orange-500 italic font-[Plus_Jakarta_Sans] leading-[1.65] min-h-[135px] transition-colors duration-150 placeholder-[#2d3a4f] focus:bg-blue-500/[0.03]"
                            >{{ old('description_en', $expeditionDesc->description_en) }}</textarea>
                            @error('description_en')
                                <p class="text-[0.72rem] text-red-400 px-4 pb-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-6 flex-wrap">
                    <div class="flex items-center gap-1.5 text-[0.75rem] text-slate-600">
                        <svg class="opacity-60 shrink-0" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        Created: {{ $expeditionDesc->created_at->format('M d, Y · h:i A') }}
                    </div>

                    <div class="flex items-center gap-1.5 text-[0.75rem] text-slate-600">
                        <svg class="opacity-60 shrink-0" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        Updated: {{ $expeditionDesc->updated_at->format('M d, Y · h:i A') }}
                    </div>
                </div>

            </div>

        </div>

    </div>

</form>

<form
    id="delete-form"
    method="POST"
    action="{{ route('expedition-descs.destroy', $expeditionDesc) }}"
    onsubmit="return confirm('Delete expedition description #{{ $expeditionDesc->id }}? This cannot be undone.')"
    class="hidden"
>
    @csrf
    @method('DELETE')
</form>

@endsection