@extends('tl-manager.translation.layouts.app')

@section('title', 'Import Furniture Descriptions')

@section('content')

@include('tl-manager.translation.furniture-descs.partials.sidebar')

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
            <h1 class="text-slate-100 tracking-tight leading-tight mt-1.5">Import Furniture Descriptions</h1>
            <p class="text-[0.8rem] text-slate-500 mt-0.5">Upload a JSON file to batch-import localization entries.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('furniture-descs.index') }}"
               class="inline-flex items-center gap-1.5 px-[1.1rem] py-2 rounded-[0.55rem] text-[0.8rem] font-semibold cursor-pointer no-underline transition-all duration-150 border border-[#252a38] bg-[#181c27] text-slate-400 hover:bg-[#1e2436] hover:text-slate-200 whitespace-nowrap font-[Plus_Jakarta_Sans]">
                Cancel
            </a>
            <button type="submit" form="import-form"
                    class="inline-flex items-center gap-1.5 px-[1.1rem] py-2 rounded-[0.55rem] text-[0.8rem] font-semibold cursor-pointer transition-all duration-150 border border-blue-700 bg-blue-600 text-white hover:bg-blue-700 hover:shadow-[0_0_0_3px_rgba(59,130,246,0.2)] whitespace-nowrap font-[Plus_Jakarta_Sans]">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                Import
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
                    <span class="text-[0.78rem] font-bold text-slate-400 tracking-[0.04em]">Import Rules</span>
                </div>

                <div class="p-[1.1rem] flex flex-col gap-3">

                    <div class="flex items-start gap-[0.55rem] text-[0.77rem] text-slate-500 leading-relaxed px-3 py-[0.55rem] bg-[#0f1117] border border-[#1e2436] rounded-lg">
                        <svg class="text-green-500 shrink-0 mt-[1px]" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        JSON format only (.json)
                    </div>

                    <div class="flex items-start gap-[0.55rem] text-[0.77rem] text-slate-500 leading-relaxed px-3 py-[0.55rem] bg-[#0f1117] border border-[#1e2436] rounded-lg">
                        <svg class="text-green-500 shrink-0 mt-[1px]" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Max file size: 10 MB
                    </div>

                    <div class="flex items-start gap-[0.55rem] text-[0.77rem] text-slate-500 leading-relaxed px-3 py-[0.55rem] bg-[#0f1117] border border-[#1e2436] rounded-lg">
                        <svg class="text-orange-500 shrink-0 mt-[1px]" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                            <line x1="12" y1="9" x2="12" y2="13"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                        Duplicate Furniture Description ID will be updated
                    </div>

                    <div class="flex items-start gap-[0.55rem] text-[0.77rem] text-slate-500 leading-relaxed px-3 py-[0.55rem] bg-[#0f1117] border border-[#1e2436] rounded-lg">
                        <svg class="text-blue-500 shrink-0 mt-[1px]" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="16" x2="12" y2="12"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                        </svg>
                        Must match the export structure
                    </div>

                </div>
            </div>

            <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                <div class="flex items-center justify-between px-4 py-[0.65rem] border-b border-[#1e2436] bg-[#0f1117]">
                    <span class="text-[0.68rem] font-bold tracking-[0.12em] uppercase text-slate-600">Example Format</span>
                    <span class="text-[0.65rem] text-slate-700 font-mono bg-[#181c27] px-2 py-[0.15rem] rounded-[0.3rem] border border-[#252a38]">JSON</span>
                </div>
                <div class="p-[1.1rem] overflow-x-auto">
<pre class="font-mono text-[0.78rem] leading-[1.8] text-slate-400 m-0 whitespace-pre"><span class="text-slate-600">{</span>
  <span class="text-blue-400">"_furniture_id_1"</span><span class="text-slate-600">:</span> <span class="text-green-400">""</span><span class="text-slate-600">,</span>
  <span class="text-blue-400">"鎮守府の床"</span><span class="text-slate-600">:</span> <span class="text-green-400">"Naval Base Floor"</span><span class="text-slate-600">,</span>
  <span class="text-blue-400">"鎮守府の艦隊司令官室。"</span><span class="text-slate-600">:</span> <span class="text-green-400">"ABCD"</span>
<span class="text-slate-600">}</span></pre>
                </div>
            </div>

        </div>

        <form
            id="import-form"
            method="POST"
            action="{{ route('furniture-descs.import') }}"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="flex flex-col gap-4">

                <div class="bg-[#13161f] border border-[#1e2436] rounded-[0.85rem] overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-[0.7rem] border-b border-[#1e2436] bg-[#0f1117]">
                        <svg class="text-blue-500 opacity-80 shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" y1="3" x2="12" y2="15"/>
                        </svg>
                        <span class="text-[0.78rem] font-bold text-slate-400 tracking-[0.04em]">Upload File</span>
                    </div>

                    <div id="uploadZone"
                         class="relative mx-[1.1rem] mt-[1.1rem] border-[1.5px] border-dashed border-[#252a38] rounded-[0.7rem] py-[7.8rem] px-4 text-center cursor-pointer transition-all duration-200 bg-[#0f1117] hover:border-blue-500 hover:bg-blue-500/[0.04]">
                        <input
                            type="file"
                            name="json_file"
                            id="json_file"
                            accept=".json"
                            required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        >
                        <div id="uploadIcon"
                             class="w-10 h-10 rounded-[0.6rem] bg-[#181c27] border border-[#252a38] flex items-center justify-center mx-auto mb-[0.85rem] text-slate-600 transition-all duration-200">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                        </div>
                        <p id="uploadLabel" class="text-[0.82rem] font-semibold text-slate-400 mb-0.5">Drop file here or click to browse</p>
                        <p class="text-[0.72rem] text-slate-600">.json files only</p>
                    </div>

                    <div id="fileSelected"
                         class="hidden items-center gap-2 mx-[1.1rem] mb-4 mt-3 px-[0.85rem] py-[0.6rem] bg-green-500/[0.08] border border-green-500/20 rounded-[0.55rem] text-[0.78rem] text-green-400">
                        <svg class="shrink-0" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <span id="fileName">No file selected</span>
                    </div>

                    @error('json_file')
                        <p class="text-[0.72rem] text-red-400 mx-[1.1rem] mt-1">{{ $message }}</p>
                    @enderror

                    <label class="flex items-start gap-[0.6rem] mx-[1.1rem] mb-[1.1rem] mt-3 px-[0.9rem] py-3 bg-orange-500/[0.06] border border-orange-500/20 rounded-[0.55rem] text-[0.78rem] text-slate-400 leading-relaxed cursor-pointer">
                        <input type="checkbox" name="confirm" class="mt-[1px] accent-orange-500 shrink-0 cursor-pointer">
                        <span>I understand that duplicate Furniture Description IDs will be <strong class="text-orange-500">overwritten</strong> during import.</span>
                    </label>

                </div>

            </div>

        </form>

    </div>

</div>

<script>
    const fileInput    = document.getElementById('json_file');
    const uploadZone   = document.getElementById('uploadZone');
    const fileSelected = document.getElementById('fileSelected');
    const fileName     = document.getElementById('fileName');
    const uploadLabel  = document.getElementById('uploadLabel');
    const uploadIcon   = document.getElementById('uploadIcon');

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length) {
            const name = fileInput.files[0].name;
            fileName.textContent = name;
            fileSelected.classList.remove('hidden');
            fileSelected.classList.add('flex');
            uploadZone.classList.remove('border-[#252a38]', 'hover:border-blue-500', 'hover:bg-blue-500/[0.04]');
            uploadZone.classList.add('border-green-500', 'bg-green-500/[0.04]');
            uploadIcon.classList.remove('bg-[#181c27]', 'border-[#252a38]', 'text-slate-600');
            uploadIcon.classList.add('bg-green-500/10', 'border-green-500/30', 'text-green-400');
            uploadLabel.textContent = 'File ready to import';
        }
    });

    uploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadZone.classList.add('border-blue-500', 'bg-blue-500/[0.04]');
    });

    uploadZone.addEventListener('dragleave', () => {
        if (!fileInput.files.length) {
            uploadZone.classList.remove('border-blue-500', 'bg-blue-500/[0.04]');
        }
    });

    uploadZone.addEventListener('drop', () => {
        uploadZone.classList.remove('border-blue-500', 'bg-blue-500/[0.04]');
    });
</script>

@endsection