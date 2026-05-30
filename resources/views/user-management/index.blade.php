@extends('tl-manager.layouts.app')

@section('title', 'User Management')

@section('content')

<div class="space-y-6">
    <div
        class="relative overflow-hidden rounded-xl border border-surface-border bg-surface-card p-8 shadow-glow">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(249,115,22,0.15),transparent_35%)]">
        </div>
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <p class="text-accent text-sm font-semibold tracking-widest uppercase">
                    KanColle Patch Indonesia
                </p>
                <h1 class="text-3xl md:text-4xl font-bold text-white mt-2">
                    Account Management
                </h1>
                <p class="text-gray-400 mt-3 max-w-2xl">
                    Manage user accounts, roles, and permissions.
                </p>
            </div>
            <div
                class="flex items-center gap-4 bg-sidebar-active border border-sidebar-border rounded-xl px-5 py-4">
                <div
                    class="w-14 h-14 rounded-xl bg-accent-muted flex items-center justify-center text-accent text-2xl">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-400">
                        Active Users
                    </p>
                    <h2 class="text-3xl font-bold text-white">
                        {{ count($users) }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

@if (session('success'))

    <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/5 px-4 py-3 text-emerald-300">
        {{ session('success') }}
    </div>

@endif

<div class="rounded-2xl border border-white/5 bg-[#181c27] overflow-hidden">

    <div class="p-6 border-b border-white/5">

        <form method="GET"
            action="{{ route('users.index') }}"
            class="flex flex-col md:flex-row gap-3">

            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search by name or email..."
                class="flex-1 rounded-xl border border-white/10 bg-[#13161f] px-4 py-3 text-white placeholder:text-gray-500 focus:border-orange-500/40 focus:ring focus:ring-orange-500/10">

            <button
                type="submit"
                class="rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-3 text-sm font-medium text-white transition">

                Search

            </button>

        </form>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b border-white/5 bg-[#13161f]">

                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.12em] text-gray-400">
                        User
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.12em] text-gray-400">
                        Email
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.12em] text-gray-400">
                        Role
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.12em] text-gray-400">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($users as $user)

                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition">

                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                @if($user->profile_photo)

                                    <img
                                        src="{{ asset('storage/' . $user->profile_photo) }}"
                                        class="w-10 h-10 rounded-xl object-cover border border-white/10">

                                @else

                                    <div class="w-10 h-10 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-sm font-bold text-orange-300">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                @endif

                                <span class="font-medium text-white">
                                    {{ $user->name }}
                                </span>

                            </div>

                        </td>

                        <td class="px-6 py-4 text-gray-300">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">

                            <span
                                class="inline-flex items-center rounded-xl px-3 py-1 text-xs font-medium border

                                @if ($user->role === 'admin')
                                    border-red-500/20 bg-red-500/10 text-red-300
                                @elseif ($user->role === 'verified')
                                    border-emerald-500/20 bg-emerald-500/10 text-emerald-300
                                @else
                                    border-yellow-500/20 bg-yellow-500/10 text-yellow-300
                                @endif">

                                {{ ucfirst($user->role) }}

                            </span>

                        </td>
                        <td class="px-6 py-4 align-middle">
                            <div class="relative inline-flex items-center">

                                <form method="POST" action="{{ route('users.updateRole', $user) }}" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    <select
                                        name="role"
                                        onchange="this.form.submit()"
                                        class="appearance-none h-10 rounded-xl border border-white/10 bg-[#13161f] pl-3 pr-10 text-sm text-white focus:border-orange-500/40 focus:ring focus:ring-orange-500/10">

                                        <option value="unverified" @selected($user->role === 'unverified')>Unverified</option>
                                        <option value="verified" @selected($user->role === 'verified')>Verified</option>
                                        <option value="admin" @selected($user->role === 'admin')>Admin</option>

                                    </select>
                                    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-white/60">
                                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5.5 7.5l4.5 4.5 4.5-4.5" />
                                        </svg>
                                    </div>

                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="px-6 py-10 text-center text-gray-500">

                            No users found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div>

    {{ $users->links() }}

</div>
</div>

@endsection
