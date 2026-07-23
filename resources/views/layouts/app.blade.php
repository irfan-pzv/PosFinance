<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 overscroll-none">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="data:,">
    <title>@yield('title', 'Dashboard POS FINANCE - PT Pos Indonesia (Persero)')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Vite Assets (Tailwind CSS & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased text-slate-800 bg-[#F4F6F9] min-h-screen flex flex-col selection:bg-[#FF6600] selection:text-white overscroll-none">

    <!-- Top Navbar -->
    @include('partials.navbar')

    <!-- Main Workspace Area -->
    <div class="flex flex-1 relative min-h-[calc(100vh-65px)]">
        <!-- Sidebar Mobile Backdrop -->
        <div id="sidebarBackdrop"></div>

        <!-- Left Navigation Sidebar -->
        @include('partials.sidebar')

        <!-- Content Body Area -->
        <main class="flex-1 min-w-0 w-full p-4 md:p-6 lg:p-8 overflow-x-hidden transition-all duration-300">
            @yield('content')
        </main>
    </div>

    <!-- Layout Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle Functionality
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');

            function toggleSidebar() {
                document.body.classList.toggle('sidebar-open');
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function() {
                    document.body.classList.remove('sidebar-open');
                });
            }

            // User Profile Menu Dropdown Toggle
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userMenuDropdown = document.getElementById('userMenuDropdown');

            if (userMenuBtn && userMenuDropdown) {
                userMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userMenuDropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', function(e) {
                    if (!userMenuDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
                        userMenuDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
