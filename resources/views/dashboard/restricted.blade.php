<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-center py-12">
                        <div class="mb-6">
                            <svg class="mx-auto h-12 w-12 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0-10.5v.5m0 7v.5M9 3h6m0 0a9 9 0 110 18H9a9 9 0 010-18zm0 0V3m0 18v-6m0-10v.5m0 7v.5" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Account Verification Pending</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Your account is currently unverified. To access the full translation system, an administrator needs to verify your account.
                        </p>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-6">
                            <p class="text-yellow-800 dark:text-yellow-200 text-sm">
                                <strong>What you can do:</strong>
                            </p>
                            <ul class="text-yellow-700 dark:text-yellow-300 text-sm mt-2 space-y-1 text-left">
                                <li>✓ Edit your profile information</li>
                                <li>✓ Change your password</li>
                                <li>✗ Access translation modules</li>
                                <li>✗ View translation data</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
