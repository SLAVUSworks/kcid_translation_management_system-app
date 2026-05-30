<section>
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">

    @csrf
    @method('patch')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        @if ($user->role !== 'unverified')

            <div class="lg:col-span-1">

                <div class="rounded-2xl border border-white/5 bg-[#13161f] p-5">

                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-orange-400 mb-4">
                        Profile Photo
                    </p>

                    <div class="flex flex-col items-center text-center">

                        @if ($user->profile_photo)

                            <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                alt="{{ $user->name }}"
                                class="w-32 h-32 rounded-2xl object-cover border border-white/10 shadow-lg">

                        @else

                            <div class="w-32 h-32 rounded-2xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-3xl font-bold text-orange-300">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                        @endif

                        <div class="w-full mt-5">

                            <label for="profile_photo"
                                class="block text-sm font-medium text-gray-300 mb-2">
                                Upload New Photo
                            </label>

                            <input id="profile_photo"
                                name="profile_photo"
                                type="file"
                                accept="image/*"
                                class="block w-full rounded-xl border border-white/10 bg-[#1e2436] px-4 py-3 text-sm text-gray-300 file:mr-4 file:rounded-lg file:border-0 file:bg-orange-500/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-orange-300 hover:file:bg-orange-500/20">

                            <x-input-error class="mt-2"
                                :messages="$errors->get('profile_photo')" />

                            <p class="mt-3 text-xs text-gray-500">
                                JPEG, PNG, GIF — Max 2MB
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        @endif

        <div class="{{ $user->role !== 'unverified' ? 'lg:col-span-2' : 'lg:col-span-3' }}">

            <div class="space-y-5">

                <div>

                    <label for="name"
                        class="block text-sm font-medium text-gray-300 mb-2">
                        Name
                    </label>

                    <input id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                        autocomplete="name"
                        class="w-full rounded-xl border border-white/10 bg-[#1e2436] px-4 py-3 text-white placeholder:text-gray-500 focus:border-orange-500/40 focus:ring focus:ring-orange-500/10">

                    <x-input-error class="mt-2"
                        :messages="$errors->get('name')" />

                </div>

                <div>

                    <label for="email"
                        class="block text-sm font-medium text-gray-300 mb-2">
                        Email Address
                    </label>

                    <input id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="username"
                        class="w-full rounded-xl border border-white/10 bg-[#1e2436] px-4 py-3 text-white placeholder:text-gray-500 focus:border-orange-500/40 focus:ring focus:ring-orange-500/10">

                    <x-input-error class="mt-2"
                        :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                        <div class="mt-4 rounded-xl border border-yellow-500/20 bg-yellow-500/5 p-4">

                            <p class="text-sm text-yellow-100">

                                Your email address is unverified.

                                <button form="send-verification"
                                    class="ml-1 font-medium text-yellow-300 hover:text-yellow-200 underline underline-offset-4">

                                    Resend verification email

                                </button>

                            </p>

                            @if (session('status') === 'verification-link-sent')

                                <p class="mt-2 text-sm text-emerald-300">
                                    A new verification link has been sent to your email address.
                                </p>

                            @endif

                        </div>

                    @endif

                </div>

                <div class="flex items-center gap-4 pt-2">

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-orange-500 px-5 py-3 text-sm font-medium text-white hover:bg-orange-600 transition">

                        Save Changes

                    </button>

                    @if (session('status') === 'profile-updated')

                        <p x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-emerald-400">

                            Profile updated successfully.

                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</form>
</section>
