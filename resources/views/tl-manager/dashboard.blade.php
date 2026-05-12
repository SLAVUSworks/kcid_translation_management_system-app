@extends('tl-manager.layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach ($menus as $menu)

        <a
            href="{{ route($menu['route']) }}"
            class="border rounded-xl p-6 hover:shadow-lg transition bg-white"
        >
            <div class="flex items-center gap-4">

                <div class="text-3xl">
                    <i class="{{ $menu['icon'] }}"></i>
                </div>

                <div>
                    <h2 class="text-xl font-semibold">
                        {{ $menu['title'] }}
                    </h2>

                    <p class="text-gray-500 text-sm">
                        {{ $menu['description'] }}
                    </p>
                </div>

            </div>
        </a>

    @endforeach

</div>

@endsection