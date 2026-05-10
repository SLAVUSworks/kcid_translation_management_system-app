@extends('layouts.app')

@section('title', 'Quests')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold">Quests</h1>
            <p class="text-slate-500 text-sm">Manage translation quests</p>
        </div>

        <div class="flex gap-2">

            <a href="{{ route('quests.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 rounded-lg
               bg-blue-600 text-white text-sm font-medium
               hover:bg-blue-700 active:bg-blue-800
               transition shadow-sm hover:shadow-md">
                + New
            </a>

            <a href="{{ route('quests.export') }}"
               class="inline-flex items-center justify-center px-4 py-2 rounded-lg
               bg-white text-slate-700 text-sm font-medium
               border border-slate-200
               hover:bg-slate-50 hover:border-slate-300
               transition">
                Export
            </a>

        </div>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('quests.index') }}" class="flex gap-2">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search quests..."
            class="input-field flex-1"
        >

        <button type="submit"
            class="inline-flex items-center justify-center px-4 py-2 rounded-lg
            bg-blue-600 text-white text-sm font-medium
            hover:bg-blue-700 transition">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('quests.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 rounded-lg
               bg-white text-slate-700 text-sm font-medium
               border border-slate-200
               hover:bg-slate-50 transition">
                Clear
            </a>
        @endif

    </form>

    {{-- LIST --}}
    <div class="space-y-3">

        @forelse($quests as $quest)
            <div class="card flex items-start justify-between gap-4">

                {{-- LEFT --}}
                <div class="space-y-1">

                    <div class="flex items-center gap-2">
                        <span class="font-bold text-blue-600">
                            #{{ $quest->quest_id }}
                        </span>

                        <span class="text-xs font-mono text-slate-500">
                            {{ $quest->quest_code }}
                        </span>

                        @if($quest->description_jp)
                            <span class="text-xs px-2 py-0.5 rounded bg-green-100 text-green-700">
                                Has Desc
                            </span>
                        @endif
                    </div>

                    <p class="text-sm text-slate-900">
                        {{ $quest->title_en }}
                    </p>

                    <p class="text-xs text-slate-500">
                        {{ $quest->title_jp }}
                    </p>

                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center gap-3 shrink-0">

                    <a href="{{ route('quests.edit', $quest) }}"
                       class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline transition">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('quests.destroy', $quest) }}"
                          onsubmit="return confirm('Delete this quest?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="text-sm font-medium text-red-600 hover:text-red-800 hover:underline transition">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        @empty

            <div class="text-center py-12 text-slate-500">
                No quests found
            </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="pt-4">
        {{ $quests->links() }}
    </div>

</div>
@endsection