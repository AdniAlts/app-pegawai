<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-blue-600 shadow-lg w-full">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-white text-xl font-bold">@yield('page-title', 'App Pegawai')</h1>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/employees') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Employees</a>
                        <a href="{{ url('/departments') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Departments</a>
                        <a href="{{ url('/positions') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Positions</a>
                        <a href="{{ url('/salaries') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Salaries</a>
                        <a href="{{ url('/attendance') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Attendance</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 w-full bg-white">
        <div class="max-w-7xl mx-auto min-h-[calc(100vh-8rem)] py-6 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} App Pegawai. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>