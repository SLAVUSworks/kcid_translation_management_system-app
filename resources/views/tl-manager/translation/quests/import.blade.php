@extends('layouts.app')

@section('title', 'Import Quests')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="space-y-1">
        <h1 class="text-3xl font-bold">Import Quests</h1>
        <p class="text-slate-500 text-sm">Upload JSON file to import quests</p>
    </div>

    {{-- GUIDELINES (subtle) --}}
    <div class="text-xs text-slate-500 space-y-1 leading-relaxed">
        <p>• JSON format only (.json)</p>
        <p>• Max file size: 10 MB</p>
        <p>• Duplicate Quest ID will be updated</p>
        <p>• Must match export structure</p>
    </div>

    {{-- FORM --}}
    <div class="card">

        <form method="POST"
              action="{{ route('quests.import') }}"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            {{-- UPLOAD --}}
            <div>
                <label class="label">JSON File</label>

                <div class="relative">

                    <input type="file"
                           name="json_file"
                           id="json_file"
                           accept=".json"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                           required>

                    <div id="uploadArea"
                         class="border border-dashed border-slate-300 rounded-lg p-6 text-center
                         hover:border-blue-500 hover:bg-slate-50 transition">

                        <p class="text-sm font-medium text-slate-700">
                            Drop file here or click to upload
                        </p>
                        <p class="text-xs text-slate-500 mt-1">
                            .json only
                        </p>

                    </div>

                </div>

                <div id="fileInfo" class="mt-2 hidden text-xs text-slate-500">
                    Selected: <span id="fileName" class="font-medium text-slate-800"></span>
                </div>

                @error('json_file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- CONFIRM --}}
            <label class="flex items-start gap-2 text-sm text-slate-600">

                <input type="checkbox"
                       name="confirm"
                       class="mt-1">

                <span>
                    I understand duplicate Quest IDs will be overwritten
                </span>

            </label>

            {{-- ACTIONS --}}
            <div class="flex gap-2 pt-2">

                <button type="submit"
                        class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg
                        bg-blue-600 text-white text-sm font-medium
                        hover:bg-blue-700 transition shadow-sm">
                    Import
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

    {{-- JSON SAMPLE (less heavy) --}}
    <div class="space-y-2">

        <p class="text-sm font-semibold text-slate-700">
            Example Format
        </p>

        <div class="text-xs bg-slate-900 text-slate-100 rounded-lg p-4 overflow-x-auto">
<pre>{
  "_quest_id_101": "_quest_code_A1",
  "はじめての編成": "First Fleet Setup",
  "艦隊を編成せよ": "Form a fleet"
}</pre>
        </div>

    </div>

</div>

{{-- SCRIPT --}}
<script>
const fileInput = document.getElementById('json_file');
const fileInfo = document.getElementById('fileInfo');
const fileName = document.getElementById('fileName');

fileInput.addEventListener('change', () => {
    if (fileInput.files.length) {
        fileName.textContent = fileInput.files[0].name;
        fileInfo.classList.remove('hidden');
    }
});
</script>
@endsection