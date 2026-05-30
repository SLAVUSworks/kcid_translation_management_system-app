@extends('tl-manager.layouts.app')

@section('title', 'Restricted Access')

@section('content')

<div class="flex items-center justify-center min-h-[calc(100vh-10rem)]">

<div class="w-full max-w-2xl">

    <div class="rounded-2xl border border-yellow-500/20 bg-[#181c27] shadow-[0_0_40px_rgba(249,115,22,0.08)] overflow-hidden">

        <div class="border-b border-yellow-500/10 px-6 py-5">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-yellow-500/10 border border-yellow-500/20">

                    <svg class="h-7 w-7 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                    </svg>

                </div>

                <div>

                    <h1 class="text-2xl font-bold text-white">
                        Account Verification Pending
                    </h1>

                    <p class="text-sm text-gray-400 mt-1">
                        Your account is currently waiting for administrator approval.
                    </p>

                </div>

            </div>

        </div>

        <div class="p-6 space-y-6">

            <div class="rounded-xl border border-yellow-500/20 bg-yellow-500/5 p-4">

                <p class="text-sm leading-relaxed text-yellow-100/90">
                    Your account has been successfully created, but you still have
                    <span class="font-semibold text-yellow-300">
                        Unverified
                    </span>
                    status. Please wait until an administrator grants access to the translation system.
                </p>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/5 p-4">

                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-emerald-400 mb-3">
                        Available
                    </p>

                    <ul class="space-y-2 text-sm text-emerald-200">

                        <li class="flex items-center gap-2">
                            <span>✓</span>
                            <span>Edit profile information</span>
                        </li>

                        <li class="flex items-center gap-2">
                            <span>✓</span>
                            <span>Change password</span>
                        </li>

                        <li class="flex items-center gap-2">
                            <span>✓</span>
                            <span>Access account settings</span>
                        </li>

                    </ul>

                </div>

                <div class="rounded-xl border border-red-500/20 bg-red-500/5 p-4">

                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-red-400 mb-3">
                        Restricted
                    </p>

                    <ul class="space-y-2 text-sm text-red-200">

                        <li class="flex items-center gap-2">
                            <span>✗</span>
                            <span>Translation modules</span>
                        </li>

                        <li class="flex items-center gap-2">
                            <span>✗</span>
                            <span>Translation management</span>
                        </li>

                        <li class="flex items-center gap-2">
                            <span>✗</span>
                            <span>Translation data access</span>
                        </li>

                    </ul>

                </div>

            </div>

            <div class="flex items-center justify-between flex-wrap gap-4 pt-2">

                <div>
                    <p class="text-sm text-gray-400">
                        Logged in as:
                    </p>

                    <p class="font-semibold text-white">
                        {{ auth()->user()->name }}
                    </p>
                </div>

                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-orange-500/20 bg-orange-500/10 hover:bg-orange-500/20 px-5 py-3 text-sm font-medium text-orange-300 transition">

                    Edit Profile

                </a>

            </div>

        </div>

    </div>

</div>
</div>

@endsection
