<section>
<form method="post"action="{{ route('password.update') }}">

    @csrf
    @method('put')

    <div class="space-y-5">

        <div>

            <label for="update_password_current_password"
                class="block text-sm font-medium text-gray-300 mb-2">

                Current Password

            </label>

            <input id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full rounded-xl border border-white/10 bg-[#1e2436] px-4 py-3 text-white placeholder:text-gray-500 focus:border-orange-500/40 focus:ring focus:ring-orange-500/10">

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2" />

        </div>

        <div>

            <label for="update_password_password"
                class="block text-sm font-medium text-gray-300 mb-2">

                New Password

            </label>

            <input id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-xl border border-white/10 bg-[#1e2436] px-4 py-3 text-white placeholder:text-gray-500 focus:border-orange-500/40 focus:ring focus:ring-orange-500/10">

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2" />

        </div>

        <div>

            <label for="update_password_password_confirmation"
                class="block text-sm font-medium text-gray-300 mb-2">

                Confirm Password

            </label>

            <input id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-xl border border-white/10 bg-[#1e2436] px-4 py-3 text-white placeholder:text-gray-500 focus:border-orange-500/40 focus:ring focus:ring-orange-500/10">

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2" />

        </div>

        <div class="flex items-center gap-4 pt-2">

            <button type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-orange-500 px-5 py-3 text-sm font-medium text-white hover:bg-orange-600 transition">

                Save Password

            </button>

            @if (session('status') === 'password-updated')

                <p x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-400">

                    Password updated successfully.

                </p>

            @endif

        </div>

    </div>

</form>
</section>
