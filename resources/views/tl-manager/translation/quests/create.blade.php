@extends('layouts.app')

@section('title', 'Create Quest')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="space-y-1">
        <h1 class="text-3xl font-bold">Create Quest</h1>
        <p class="text-slate-500 text-sm">Add a new translation entry</p>
    </div>

    {{-- FORM --}}
    <div class="card">

        <form method="POST" action="{{ route('quests.store') }}" class="space-y-5">
            @csrf

            {{-- QUEST ID --}}
            <div>
                <label class="label">Quest ID</label>
                <input type="number" name="quest_id"
                    value="{{ old('quest_id') }}"
                    placeholder="e.g. 101"
                    class="input-field"
                    required>
                @error('quest_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- CODE --}}
            <div>
                <label class="label">Quest Code</label>
                <input type="text" name="quest_code"
                    value="{{ old('quest_code') }}"
                    placeholder="_quest_code_A1"
                    class="input-field"
                    required>
                @error('quest_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TITLES --}}
            <div class="pt-2">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">
                    Titles
                </p>

                <div class="space-y-4">

                    <div>
                        <label class="label">Japanese</label>
                        <textarea name="title_jp" rows="2"
                            placeholder="Enter Japanese title"
                            class="input-field"
                            required>{{ old('title_jp') }}</textarea>
                        @error('title_jp')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label">English</label>
                        <textarea name="title_en" rows="2"
                            placeholder="Enter English title"
                            class="input-field"
                            required>{{ old('title_en') }}</textarea>
                        @error('title_en')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="pt-2">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">
                    Description (optional)
                </p>

                <div class="space-y-4">

                    <div>
                        <label class="label">Japanese</label>
                        <textarea name="description_jp" rows="3"
                            placeholder="Optional description"
                            class="input-field">{{ old('description_jp') }}</textarea>
                    </div>

                    <div>
                        <label class="label">English</label>
                        <textarea name="description_en" rows="3"
                            placeholder="Optional translation"
                            class="input-field">{{ old('description_en') }}</textarea>
                    </div>

                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="flex gap-2 pt-4">

                <button type="submit"
                    class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg
                    bg-blue-600 text-white text-sm font-medium
                    hover:bg-blue-700 transition shadow-sm">
                    Create
                </button>

                <a href="{{ route('quests.index') }}"
                   class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg
                   bg-white border border-slate-200 text-slate-700 text-sm font-medium
                   hover:bg-slate-50 transition">
                    Cancel
                </a>

            </div>

        </form>

    </div>

    {{-- HELPER (subtle, not noisy) --}}
    <div class="text-xs text-slate-500 space-y-1 leading-relaxed">
        <p>• Quest ID controls ordering in exports</p>
        <p>• Quest Code should be unique (e.g. _quest_code_A1)</p>
        <p>• Descriptions are optional but recommended</p>
    </div>

</div>
@endsection