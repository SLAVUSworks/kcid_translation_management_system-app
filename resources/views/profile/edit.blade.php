@extends('tl-manager.layouts.app')

@section('title', 'Profile Settings')

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
                    Profile Settings
                </h1>
                <p class="text-gray-400 mt-3 max-w-2xl">
                    Manage your account information and security settings.
                </p>
            </div>
        </div>
    </div>

<div class="grid grid-cols-1 gap-6">

    <div class="rounded-2xl border border-white/5 bg-[#181c27] overflow-hidden">

        <div class="border-b border-white/5 px-6 py-4">

            <h2 class="text-lg font-semibold text-white">
                Profile Information
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Update your account profile information and email address.
            </p>

        </div>

        <div class="p-6">

            @include('profile.partials.update-profile-information-form')

        </div>

    </div>

    <div class="rounded-2xl border border-white/5 bg-[#181c27] overflow-hidden">

        <div class="border-b border-white/5 px-6 py-4">

            <h2 class="text-lg font-semibold text-white">
                Update Password
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Ensure your account is using a secure password.
            </p>

        </div>

        <div class="p-6">

            @include('profile.partials.update-password-form')

        </div>

    </div>

    <div class="rounded-2xl border border-red-500/10 bg-[#181c27] overflow-hidden">

        <div class="border-b border-red-500/10 px-6 py-4">

            <h2 class="text-lg font-semibold text-red-300">
                Delete Account
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Permanently delete your account and all associated data.
            </p>

        </div>

        <div class="p-6">

            @include('profile.partials.delete-user-form')

        </div>

    </div>

</div>
</div>

@endsection
