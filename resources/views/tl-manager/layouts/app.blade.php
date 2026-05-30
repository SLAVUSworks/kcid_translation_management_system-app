<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Translation Management')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sidebar: {
                            DEFAULT: '#0f1117',
                            hover: '#1a1d27',
                            active: '#1e2130',
                            border: '#1e2436',
                        },
                        accent: {
                            DEFAULT: '#f97316',
                            muted: 'rgba(249,115,22,0.12)',
                        },
                        surface: {
                            DEFAULT: '#13161f',
                            card: '#181c27',
                            border: '#252a38',
                        },
                    },
                    boxShadow: {
                        glow: '0 0 0 1px rgba(249,115,22,0.3), 0 4px 24px rgba(249,115,22,0.08)',
                    },
                }
            }
        }
    </script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface text-white antialiased overflow-x-hidden">

    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(249,115,22,0.08),transparent_25%)]">

        @include('tl-manager.layouts.partials.navbar')

        @include('tl-manager.layouts.partials.sidebar')

        <main class="lg:ml-72 pt-20 min-h-screen transition-all duration-300">

            <div class="p-4 md:p-6 lg:p-8">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "{{ $error }}",
                                background: '#181c27',
                                color: '#fff'
                            });
                        </script>
                    @endforeach
                @endif

                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "{{ session('success') }}",
                            background: '#181c27',
                            color: '#fff'
                        });
                    </script>
                @endif

                @yield('content')

            </div>

            @include('tl-manager.layouts.partials.footer')

        </main>

    </div>

</body>

</html>