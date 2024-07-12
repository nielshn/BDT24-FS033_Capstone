<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.8/datatables.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            {{-- Sidebar --}}
            @include('includes.sidebar')

            <!-- Page Content -->
            <div id="page-content-wrapper">
                {{-- Navbar Dashboard --}}
                @include('layouts.navigation')

                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                {{-- Section Content --}}
                <main class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    @stack('prepend-script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.8/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        // Sweet Alert integration
        document.addEventListener('DOMContentLoaded', function() {
            // Event delegation for dynamically created elements
            document.body.addEventListener('click', function(event) {
                if (event.target.closest('#delete-btn')) {
                    event.preventDefault();
                    const button = event.target.closest('#delete-btn');
                    const form = button.closest('.delete-form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
    @stack('addon-script')
</body>

</html>
