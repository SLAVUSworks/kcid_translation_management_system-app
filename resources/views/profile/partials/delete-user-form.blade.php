<section class="space-y-6">
<div class="rounded-2xl border border-red-500/10 bg-red-500/[0.03] p-5">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h3 class="text-sm font-semibold text-red-200">
                Permanent Account Removal
            </h3>

            <p class="mt-1 text-sm text-gray-400 max-w-2xl">
                This action cannot be undone. Please ensure you have saved any important data before proceeding.
            </p>

        </div>

        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex items-center justify-center rounded-xl border border-red-500/20 bg-red-500/10 px-5 py-3 text-sm font-medium text-red-300 hover:bg-red-500/20 transition">

            Delete Account

        </button>

    </div>

</div>

<x-modal name="confirm-user-deletion"
    :show="$errors->userDeletion->isNotEmpty()"
    focusable>

    <form method="post"
        action="{{ route('profile.destroy') }}"
        class="p-6 bg-[#181c27] text-white">

        @csrf
        @method('delete')

        <div class="flex items-start gap-4">

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-red-500/20 bg-red-500/10">

                <svg class="h-6 w-6 text-red-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />

                </svg>

            </div>

            <div>

                <h2 class="text-xl font-semibold text-white">
                    Delete Account
                </h2>

                <p class="mt-2 text-sm leading-relaxed text-gray-400">
                    Once your account is deleted, all data and resources will be permanently removed.
                    Please enter your password to confirm this action.
                </p>

            </div>

        </div>

        <div class="mt-6">

            <label for="password"
                class="block text-sm font-medium text-gray-300 mb-2">

                Confirm Password

            </label>

            <input id="password"
                name="password"
                type="password"
                placeholder="Enter your password"
                class="w-full rounded-xl border border-white/10 bg-[#1e2436] px-4 py-3 text-white placeholder:text-gray-500 focus:border-red-500/40 focus:ring focus:ring-red-500/10">

            <x-input-error
                :messages="$errors->userDeletion->get('password')"
                class="mt-2" />

        </div>

        <div class="mt-8 flex items-center justify-end gap-3">

            <button type="button"
                x-on:click="$dispatch('close')"
                class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-[#1e2436] px-5 py-3 text-sm font-medium text-gray-300 hover:bg-[#252a38] transition">

                Cancel

            </button>

            <button type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-red-500 px-5 py-3 text-sm font-medium text-white hover:bg-red-600 transition">

                Permanently Delete

            </button>

        </div>

    </form>

</x-modal>
</section>
