<footer class="border-t border-sidebar-border mt-10">

    <div class="px-4 md:px-6 lg:px-8 py-8">

        <div
            class="rounded-3xl border border-surface-border bg-surface-card p-6 md:p-8">

            <div
                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div>
                    <h2 class="text-2xl font-bold text-white">
                        KanColle Indonesia Translation Management System
                    </h2>

                    <p class="text-gray-400 mt-3 max-w-2xl leading-relaxed">
                        Ijal Malas Ngoding.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 sm:flex sm:items-center">

                    <div
                        class="rounded-2xl border border-sidebar-border bg-sidebar-hover px-5 py-4 text-center">

                        <p class="text-xs uppercase tracking-widest text-gray-500">
                            Framework
                        </p>

                        <h3 class="mt-2 font-semibold text-white">
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                        </h3>

                    </div>

                    <div
                        class="rounded-2xl border border-sidebar-border bg-sidebar-hover px-5 py-4 text-center">

                        <p class="text-xs uppercase tracking-widest text-gray-500">
                            Runtime
                        </p>

                        <h3 class="mt-2 font-semibold text-white">
                            PHP v{{ PHP_VERSION }}
                        </h3>

                    </div>

                </div>

            </div>

            <div
                class="mt-8 pt-6 border-t border-sidebar-border flex flex-col md:flex-row gap-3 md:items-center md:justify-between text-sm text-gray-500">

                <p>
                    © {{ date('Y') }} SLAVUSworks.
                </p>

                <p>
                    KCID Translation Management System.
                </p>

            </div>

        </div>

    </div>

</footer>