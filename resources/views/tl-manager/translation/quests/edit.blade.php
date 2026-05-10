@extends('layouts.app')

@section('title', 'Edit Quest #' . $quest->quest_id)

@section('content')
<div
    class="max-w-5xl mx-auto p-6 space-y-6"
    x-data="questEditor()"
    @keydown.ctrl.s.window.prevent="saveForm()"
    @keydown.meta.s.window.prevent="saveForm()"
>

    {{-- HEADER --}}
    <div class="flex items-start justify-between gap-4 flex-wrap">

        <div class="space-y-1">
            <a href="{{ route('quests.index') }}"
               class="text-sm text-slate-500 hover:text-slate-700 transition">
                ← Back
            </a>

            <div class="flex items-center gap-3">
                <h1 class="text-3xl font-bold">
                    Edit Quest #{{ $quest->quest_id }}
                </h1>

                <span
                    x-show="dirty"
                    x-cloak
                    class="inline-flex items-center gap-1 px-2 py-1 rounded-full
                    text-xs font-medium bg-amber-100 text-amber-700"
                >
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Unsaved Changes
                </span>
            </div>

            <p class="text-slate-500 text-sm">
                Update quest information
            </p>
        </div>

        <div class="flex items-center gap-2">

            {{-- PREVIEW TOGGLE --}}
            <button
                type="button"
                @click="showPreview = !showPreview"
                class="px-4 py-2 rounded-xl border border-slate-200
                text-sm hover:bg-slate-50 transition"
            >
                <span x-text="showPreview ? 'Hide Preview' : 'Show Preview'"></span>
            </button>

            {{-- SAVE --}}
            <button
                type="button"
                @click="saveForm()"
                :disabled="saving"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-xl
                bg-blue-600 hover:bg-blue-700 disabled:opacity-50
                text-white text-sm font-medium transition"
            >

                <svg
                    x-show="!saving"
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"/>
                </svg>

                <svg
                    x-show="saving"
                    x-cloak
                    class="w-4 h-4 animate-spin"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9"/>
                </svg>

                <span x-text="saving ? 'Saving...' : 'Save'"></span>
            </button>

        </div>

    </div>

    {{-- SHORTCUT --}}
    <div class="text-xs text-slate-400 flex items-center gap-2">
        <kbd class="px-2 py-1 rounded bg-slate-100 border">Ctrl+S</kbd>
        <span>Quick save</span>
    </div>

    {{-- FORM --}}
    <div class="card overflow-hidden">

        <form
            id="quest-form"
            method="POST"
            action="{{ route('quests.update', $quest) }}"
            class="space-y-6"
            @input="markDirty()"
        >
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">

                {{-- QUEST ID --}}
                <div>
                    <label class="label">Quest ID</label>

                    <input
                        type="number"
                        name="quest_id"
                        value="{{ old('quest_id', $quest->quest_id) }}"
                        class="input-field"
                        required
                    >

                    @error('quest_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CODE --}}
                <div>
                    <label class="label">Quest Code</label>

                    <input
                        type="text"
                        name="quest_code"
                        value="{{ old('quest_code', $quest->quest_code) }}"
                        class="input-field"
                        required
                    >

                    @error('quest_code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TITLES --}}
                <div class="space-y-5">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Titles
                            </p>
                        </div>

                        <button
                            type="button"
                            @click="autoFormatAll()"
                            class="text-xs text-blue-600 hover:text-blue-700"
                        >
                            Auto Format All
                        </button>
                    </div>

                    {{-- TITLE JP --}}
                    <div
                        class="border rounded-2xl overflow-hidden"
                        :class="dirty ? 'border-blue-300 ring-2 ring-blue-100' : 'border-slate-200'"
                    >

                        <div class="px-4 py-2 bg-slate-50 border-b flex justify-between items-center">
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Japanese
                            </label>

                            <span class="text-xs text-slate-400"
                                  x-text="charCount($refs.title_jp?.value || '') + ' chars'">
                            </span>
                        </div>

                        <div class="p-4 space-y-2">

                            <textarea
                                x-ref="title_jp"
                                name="title_jp"
                                rows="3"
                                class="input-field font-mono whitespace-pre-wrap"
                                required
                            >{{ old('title_jp', $quest->title_jp) }}</textarea>

                            {{-- RAW --}}
                            <div x-show="showPreview" x-cloak>
                                <div class="rounded-xl border bg-slate-50 p-3">
                                    <p class="text-xs font-semibold mb-2 text-slate-500">
                                        Expanded Preview
                                    </p>

                                    <pre
                                        class="whitespace-pre-wrap text-sm font-mono text-slate-700"
                                        x-text="expandNewlines($refs.title_jp?.value || '')"
                                    ></pre>
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- TITLE EN --}}
                    <div
                        class="border rounded-2xl overflow-hidden"
                        :class="dirty ? 'border-blue-300 ring-2 ring-blue-100' : 'border-slate-200'"
                    >

                        <div class="px-4 py-2 bg-slate-50 border-b flex justify-between items-center">

                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                English
                            </label>

                            <div class="flex items-center gap-2">

                                <span
                                    class="text-xs font-mono"
                                    :class="{
                                        'text-slate-400': charCount($refs.title_en?.value || '') < 40,
                                        'text-green-600': charCount($refs.title_en?.value || '') >= 40 && charCount($refs.title_en?.value || '') <= 105,
                                        'text-amber-600': charCount($refs.title_en?.value || '') > 105
                                    }"
                                    x-text="charCount($refs.title_en?.value || '') + ' chars'"
                                ></span>

                                <button
                                    type="button"
                                    @click="formatField($refs.title_en)"
                                    class="text-xs text-blue-600 hover:text-blue-700"
                                >
                                    Format
                                </button>

                            </div>

                        </div>

                        <div class="p-4 space-y-2">

                            <textarea
                                x-ref="title_en"
                                name="title_en"
                                rows="3"
                                class="input-field font-mono whitespace-pre-wrap"
                                required
                            >{{ old('title_en', $quest->title_en) }}</textarea>

                            {{-- WARNING --}}
                            <div
                                x-show="charCount($refs.title_en?.value || '') > 105"
                                x-cloak
                                class="text-xs text-amber-600"
                            >
                                ⚠ Consider formatting line breaks
                            </div>

                            {{-- PREVIEW --}}
                            <div x-show="showPreview" x-cloak>

                                <div class="rounded-xl border bg-blue-50 p-3">

                                    <p class="text-xs font-semibold mb-2 text-blue-700">
                                        Expanded Preview
                                    </p>

                                    <pre
                                        class="whitespace-pre-wrap text-sm font-mono text-slate-700"
                                        x-text="expandNewlines($refs.title_en?.value || '')"
                                    ></pre>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- DESCRIPTION --}}
                <div class="space-y-5">

                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                            Description
                        </p>
                    </div>

                    {{-- DESCRIPTION JP --}}
                    <div>
                        <label class="label">Japanese</label>

                        <textarea
                            x-ref="description_jp"
                            name="description_jp"
                            rows="4"
                            class="input-field font-mono whitespace-pre-wrap"
                        >{{ old('description_jp', $quest->description_jp) }}</textarea>

                        <div x-show="showPreview" x-cloak class="mt-2">

                            <div class="rounded-xl border bg-slate-50 p-3">

                                <pre
                                    class="whitespace-pre-wrap text-sm font-mono text-slate-700"
                                    x-text="expandNewlines($refs.description_jp?.value || '')"
                                ></pre>

                            </div>

                        </div>
                    </div>

                    {{-- DESCRIPTION EN --}}
                    <div>
                        <label class="label">English</label>

                        <div class="space-y-2">

                            <textarea
                                x-ref="description_en"
                                name="description_en"
                                rows="4"
                                class="input-field font-mono whitespace-pre-wrap"
                            >{{ old('description_en', $quest->description_en) }}</textarea>

                            <div class="flex items-center justify-between">

                                <span
                                    class="text-xs text-slate-400"
                                    x-text="charCount($refs.description_en?.value || '') + ' chars'"
                                ></span>

                                <button
                                    type="button"
                                    @click="formatField($refs.description_en)"
                                    class="text-xs text-blue-600 hover:text-blue-700"
                                >
                                    Format
                                </button>

                            </div>

                            {{-- PREVIEW --}}
                            <div x-show="showPreview" x-cloak>

                                <div class="rounded-xl border bg-blue-50 p-3">

                                    <pre
                                        class="whitespace-pre-wrap text-sm font-mono text-slate-700"
                                        x-text="expandNewlines($refs.description_en?.value || '')"
                                    ></pre>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- META --}}
                <div class="text-xs text-slate-500 border-t pt-5 space-y-1">
                    <p>Created: {{ $quest->created_at->format('d M Y H:i') }}</p>
                    <p>Updated: {{ $quest->updated_at->format('d M Y H:i') }}</p>
                </div>

            </div>

        </form>

        {{-- DANGER ZONE --}}
        <div class="border-t p-6">

            <form
                method="POST"
                action="{{ route('quests.destroy', $quest) }}"
                onsubmit="return confirm('Delete this quest? This cannot be undone.')"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center
                    px-4 py-2 rounded-xl text-sm font-medium text-red-600
                    hover:bg-red-50 transition"
                >
                    Delete Quest
                </button>

            </form>

        </div>

    </div>

    {{-- STICKY SAVE BAR --}}
    <div
        x-show="dirty"
        x-cloak
        class="sticky bottom-4"
    >

        <div class="bg-white border shadow-xl rounded-2xl p-4 flex items-center justify-between">

            <div class="text-sm text-slate-500">
                Unsaved changes detected
            </div>

            <div class="flex items-center gap-2">

                <button
                    type="button"
                    @click="dirty = false"
                    class="px-4 py-2 rounded-xl border text-sm"
                >
                    Dismiss
                </button>

                <button
                    type="button"
                    @click="saveForm()"
                    class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700
                    text-white text-sm font-medium"
                >
                    Save Changes
                </button>

            </div>

        </div>

    </div>

    {{-- TOAST CONTAINER --}}
    <div
        id="toast-container"
        class="fixed top-5 right-5 z-50 space-y-3"
    ></div>

</div>
@endsection

@push('scripts')
<script>
function questEditor() {
    return {

        dirty: false,
        saving: false,
        showPreview: false,

        markDirty() {
            this.dirty = true;
        },

        charCount(text) {
            return (text || '').length;
        },

        expandNewlines(text) {
            return (text || '').replace(/\\n/g, '\n');
        },

        formatField(field) {

            if (!field?.value) return;

            let text = field.value
                .replace(/\r\n/g, '\n')
                .replace(/\n/g, '\\n');

            const MAX = 105;

            let result = '';
            let current = '';

            const words = text.split(' ');

            for (const word of words) {

                if ((current + ' ' + word).trim().length > MAX) {

                    result += current.trim() + '\\n';

                    current = word;

                } else {

                    current += ' ' + word;

                }
            }

            result += current.trim();

            field.value = result;

            this.markDirty();

            this.showToast('Text formatted successfully', 'success');
        },

        async autoFormatAll() {

            const fields = [
                this.$refs.title_en,
                this.$refs.description_en,
            ];

            for (const field of fields) {
                this.formatField(field);
            }

            this.showToast('All fields formatted', 'success');
        },

        async saveForm() {

            this.saving = true;

            try {

                document.getElementById('quest-form').submit();

            } catch (e) {

                this.showToast('Save failed', 'error');

                this.saving = false;

            }
        },

        showToast(message, type = 'success') {

            const container = document.getElementById('toast-container');

            const toast = document.createElement('div');

            toast.className = `
                px-4 py-3 rounded-xl shadow-lg border bg-white
                flex items-center gap-2 text-sm
                ${type === 'success'
                    ? 'border-green-200 text-green-700'
                    : 'border-red-200 text-red-700'
                }
            `;

            toast.innerHTML = `
                <span>${message}</span>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        },

    };
}
</script>
@endpush