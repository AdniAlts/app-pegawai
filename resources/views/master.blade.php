<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* Custom sidebar collapse animation styles */
    #top-bar-sidebar {
        transition: width 0.3s ease-in-out;
        min-width: 80px;
    }
    
    .sidebar-text {
        transition: opacity 0.25s ease-in-out, visibility 0.25s ease-in-out;
        white-space: nowrap;
    }
    
    .sidebar-collapsed {
        overflow: visible !important;
    }
    
    .sidebar-collapsed .sidebar-text {
        opacity: 0 !important;
        visibility: hidden !important;
        width: 0; /* Tambahan: pastikan width text 0 agar tidak memakan tempat */
        display: none; /* Tambahan: sembunyikan dari flow */
    }
    
    .sidebar-collapsed .sidebar-logo span {
        opacity: 0;
        visibility: hidden;
        display: none; /* Tambahan */
    }
    
    /* Enhanced smooth transition for main content */
    .main-content {
        transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out, transform 0.15s ease-in-out;
    }
    
    .main-content-expanding {
        transform: scale(1.01);
    }
    
    footer {
        transition: margin-left 0.3s ease-in-out;
    }
    
    /* Mengatur Item Menu saat Collapse */
    .sidebar-collapsed ul li a {
        justify-content: center !important;
        padding-left: 0 !important;   /* HAPUS padding 2.5rem yang bikin miring */
        padding-right: 0 !important;  /* Pastikan kanan juga 0 */
        margin: 0.25rem 0.5rem !important;
        text-align: center; /* Pastikan align center */
    }
    
    /* Mengatur Icon saat Collapse */
    .sidebar-collapsed ul li a svg {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }
    
    /* Mengatur Logo saat Collapse */
    .sidebar-collapsed .sidebar-logo {
        justify-content: center !important;
        padding-left: 0 !important;  /* HAPUS padding logo juga */
        padding-right: 0 !important;
        margin: 0.25rem 0.5rem !important;
    }
    
    .sidebar-collapsed .sidebar-logo-icon {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    /* --- AKHIR PERBAIKAN --- */
    
    .sidebar-collapsed .sidebar-logo-text {
        opacity: 0 !important;
        visibility: hidden !important;
    }
    
    /* Logo positioning fix */
    .sidebar-logo {
        transition: all 0.3s ease-in-out;
    }
    
    .sidebar-logo-icon {
        transition: all 0.3s ease-in-out;
    }
    
    .sidebar-logo-text {
        transition: opacity 0.25s ease-in-out, visibility 0.25s ease-in-out;
    }
    
    /* Ensure logo icon is always visible and aligned */
    .sidebar-logo-icon {
        flex-shrink: 0 !important;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    
    /* Content animation enhancement */
    .content-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Ensure icons are always visible */
    .sidebar-item-icon {
        flex-shrink: 0 !important;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    
    /* Sidebar item layout fix */
    .sidebar-item {
        display: flex !important;
        align-items: center !important;
        transition: all 0.2s ease-in-out;
    }

    /* Modern Tooltip Styles - Fixed Position, Non-Responsive Breaking */
    .tooltip-container {
        position: relative;
    }
    
    .tooltip {
        position: fixed;
        z-index: 9999;
        background-color: rgba(31, 41, 55, 0.95);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        white-space: nowrap;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-5px);
        transition: opacity 0.2s ease, visibility 0.2s ease, transform 0.2s ease;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
    
    .tooltip.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    /* Tooltip Arrow */
    .tooltip::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -5px; /* Position arrow on the left side */
        transform: translateY(-50%); /* Center vertically */
        border: 5px solid transparent;
        border-right-color: rgba(31, 41, 55, 0.95); /* Arrow pointing left */
    }
    
    /* Hide tooltip on expanded sidebar */
    .tooltip.hidden-expanded {
        display: none !important;
    }
</style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Top Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">                   
                    <!-- Desktop/Mobile toggle button - Always visible -->
                    <a href="{{ url('/') }}" class="flex ms-2.5 md:me-24">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="me-3">
                        <span class="self-center text-lg font-semibold whitespace-nowrap text-gray-900">App Pegawai</span>
                    </a>

                    <button data-drawer-target="top-bar-sidebar" data-drawer-toggle="top-bar-sidebar" aria-controls="top-bar-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 border border-gray-300 mr-3" title="Toggle Sidebar">
                        <span class="sr-only">Toggle sidebar</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M3 12h18M3 20h18"/>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-600 to-blue-600 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                        <div class="z-50 hidden bg-white border border-gray-200 rounded-lg shadow-lg w-48" id="dropdown-user">
                            <div class="px-4 py-3 border-b border-gray-200" role="none">
                                <p class="text-sm font-medium text-gray-900" role="none">
                                    {{ Auth::user()->employee->name ?? 'Admin User' }}
                                </p>
                                <p class="text-xs text-gray-500 truncate" role="none">
                                    {{ Auth::user()->username }}
                                </p>
                                @if(Auth::user()->employee)
                                <p class="text-xs text-blue-600 font-medium" role="none">
                                    {{ Auth::user()->employee->position->name ?? 'No Position' }}
                                </p>
                                @endif
                            </div>
                            <ul class="p-2 text-sm text-gray-700 font-medium" role="none">
                                <li>
                                    <a href="{{ route('users.show', Auth::id()) }}" class="inline-flex items-center w-full p-2 hover:bg-gray-100 hover:text-gray-900 rounded" role="menuitem">
                                        <i class="fas fa-user mr-3 text-gray-400"></i>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center w-full p-2 hover:bg-red-50 hover:text-red-600 rounded text-red-600" role="menuitem">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="top-bar-sidebar" class="fixed top-0 left-0 z-40 w-64 h-full transition-all duration-300 ease-in-out -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 bg-white border-r border-gray-200">
            <div class="sidebar-logo flex items-center px-2 py-1.5 mb-3 rounded-lg">
                <svg class="sidebar-logo-icon w-5 h-5 flex-shrink-0 transition-all duration-300 text-gray-700" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10 9 11 5.16-1 9-5.45 9-11V7l-10-5z" fill="currentColor"/>
                    <path d="M8 12l2 2 6-6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="sidebar-logo-text ms-3 text-lg text-gray-900 font-semibold whitespace-nowrap sidebar-text transition-opacity duration-300">App Pegawai</span>
            </div>
            
            <ul class="space-y-2 font-medium mt-4">
                <li class="tooltip-container">
                    <a href="{{ url('/') }}" class="sidebar-item flex items-center px-2 py-1.5 {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : 'text-gray-700' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 group" data-tooltip="Dashboard">
                        <svg class="sidebar-item-icon w-5 h-5 transition duration-75 {{ request()->is('/') ? 'text-blue-600' : 'text-gray-500' }} group-hover:text-blue-600 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z"/>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z"/>
                        </svg>
                        <span class="ms-3 sidebar-text transition-opacity duration-300">Dashboard</span>
                    </a>
                </li>
                <li class="tooltip-container">
                    <a href="{{ url('/employees') }}" class="sidebar-item flex items-center px-2 py-1.5 {{ request()->is('employees*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 group" data-tooltip="Employees">
                        <svg class="sidebar-item-icon w-5 h-5 transition duration-75 {{ request()->is('employees*') ? 'text-blue-600' : 'text-gray-500' }} group-hover:text-blue-600 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        <span class="ms-3 sidebar-text transition-opacity duration-300">Employees</span>
                    </a>
                </li>
                <li class="tooltip-container">
                    <a href="{{ url('/departments') }}" class="sidebar-item flex items-center px-2 py-1.5 {{ request()->is('departments*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 group" data-tooltip="Departments">
                        <svg class="sidebar-item-icon w-5 h-5 transition duration-75 {{ request()->is('departments*') ? 'text-blue-600' : 'text-gray-500' }} group-hover:text-blue-600 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2v1h-2v-1Z"/>
                        </svg>
                        <span class="ms-3 sidebar-text transition-opacity duration-300">Departments</span>
                    </a>
                </li>
                <li class="tooltip-container">
                    <a href="{{ url('/positions') }}" class="sidebar-item flex items-center px-2 py-1.5 {{ request()->is('positions*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 group" data-tooltip="Positions">
                        <svg class="sidebar-item-icon w-5 h-5 transition duration-75 {{ request()->is('positions*') ? 'text-blue-600' : 'text-gray-500' }} group-hover:text-blue-600 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z"/>
                        </svg>
                        <span class="ms-3 sidebar-text transition-opacity duration-300">Positions</span>
                    </a>
                </li>
                <li class="tooltip-container">
                    <a href="{{ url('/salaries') }}" class="sidebar-item flex items-center px-2 py-1.5 {{ request()->is('salaries*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 group" data-tooltip="Salaries">
                        <svg class="sidebar-item-icon w-5 h-5 transition duration-75 {{ request()->is('salaries*') ? 'text-blue-600' : 'text-gray-500' }} group-hover:text-blue-600 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.487-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2"/>
                        </svg>
                        <span class="ms-3 sidebar-text transition-opacity duration-300">Salaries</span>
                    </a>
                </li>
                <li class="tooltip-container">
                    <a href="{{ url('/attendance') }}" class="sidebar-item flex items-center px-2 py-1.5 {{ request()->is('attendance*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 group" data-tooltip="Attendance">
                        <svg class="sidebar-item-icon w-5 h-5 transition duration-75 {{ request()->is('attendance*') ? 'text-blue-600' : 'text-gray-500' }} group-hover:text-blue-600 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                        </svg>
                        <span class="ms-3 sidebar-text transition-opacity duration-300">Attendance</span>
                    </a>
                </li>
                <li class="tooltip-container">
                    <a href="{{ url('/users') }}" class="sidebar-item flex items-center px-2 py-1.5 {{ request()->is('users*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700' }} rounded-lg hover:bg-blue-50 hover:text-blue-600 group" data-tooltip="Users">
                        <svg class="sidebar-item-icon w-5 h-5 transition duration-75 {{ request()->is('users*') ? 'text-blue-600' : 'text-gray-500' }} group-hover:text-blue-600 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        <span class="ms-3 sidebar-text transition-opacity duration-300">Users</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content content-transition p-4 sm:ml-64 mt-14 flex-1" id="main-content">
        <div class="p-4">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-green-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-red-800">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Content Section -->
            @hasSection('content')
                @yield('content')
            @else
                <!-- Default Dashboard Content -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-gray-600">Welcome to App Pegawai - Employee Management System</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <!-- Employees -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Employees</p>
                                <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Employee::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Departments -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Departments</p>
                                <p class="text-3xl font-bold text-green-600">{{ \App\Models\Department::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Positions -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Job Positions</p>
                                <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Position::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Users -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">System Users</p>
                                <p class="text-3xl font-bold text-orange-600">{{ \App\Models\User::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                        <a href="{{ url('/employees/create') }}" class="flex flex-col items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                            <svg class="w-8 h-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span class="text-sm font-medium text-blue-700">Add Employee</span>
                        </a>
                        <a href="{{ url('/departments/create') }}" class="flex flex-col items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                            <svg class="w-8 h-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span class="text-sm font-medium text-green-700">Add Department</span>
                        </a>
                        <a href="{{ url('/positions/create') }}" class="flex flex-col items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                            <svg class="w-8 h-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span class="text-sm font-medium text-purple-700">Add Position</span>
                        </a>
                        <a href="{{ url('/users/create') }}" class="flex flex-col items-center p-3 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors">
                            <svg class="w-8 h-8 text-orange-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span class="text-sm font-medium text-orange-700">Add User</span>
                        </a>
                        <a href="{{ url('/attendance') }}" class="flex flex-col items-center p-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <svg class="w-8 h-8 text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span class="text-sm font-medium text-indigo-700">Attendance</span>
                        </a>
                        <a href="{{ url('/salaries') }}" class="flex flex-col items-center p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition-colors">
                            <svg class="w-8 h-8 text-yellow-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm font-medium text-yellow-700">Salaries</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white shadow py-4 mt-auto sm:ml-64">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} App Pegawai. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Enhanced sidebar toggle functionality with smooth collapse animation and content sync
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('top-bar-sidebar');
            const mainContent = document.getElementById('main-content');
            const footer = document.querySelector('footer');
            const toggleButtons = document.querySelectorAll('[data-drawer-toggle="top-bar-sidebar"]');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            
            let isCollapsed = false;
            
            console.log('Enhanced sidebar toggle initialized'); // Debug log
            console.log('Found toggle buttons:', toggleButtons.length); // Debug log
            console.log('Found sidebar texts:', sidebarTexts.length); // Debug log
            
            // Helper function to animate content
            function animateContent(isExpanding) {
                if (mainContent) {
                    if (isExpanding) {
                        mainContent.classList.add('main-content-expanding');
                        setTimeout(() => {
                            mainContent.classList.remove('main-content-expanding');
                        }, 150);
                    }
                }
            }
            
            toggleButtons.forEach((button, index) => {
                console.log('Button', index, ':', button); // Debug log
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Toggle button clicked!'); // Debug log
                    
                    isCollapsed = !isCollapsed;
                    console.log('Sidebar collapsed:', isCollapsed); // Debug log
                    
                    if (window.innerWidth >= 640) {
                        // Desktop behavior with smooth animation
                        if (isCollapsed) {
                            // Collapse: Hide text first, then shrink sidebar
                            sidebarTexts.forEach(text => {
                                text.style.opacity = '0';
                                text.style.visibility = 'hidden';
                            });
                            
                            setTimeout(() => {
                                sidebar.style.width = '80px';
                                sidebar.classList.add('sidebar-collapsed');
                                
                                if (mainContent) {
                                    mainContent.style.marginLeft = '80px';
                                    mainContent.classList.remove('sm:ml-64');
                                }
                                if (footer) {
                                    footer.style.marginLeft = '80px';
                                    footer.classList.remove('sm:ml-64');
                                }
                                
                                // Animate content expansion
                                animateContent(true);
                            }, 100); // Faster text fade out
                            
                        } else {
                            // Expand: Expand sidebar first, then show text
                            sidebar.style.width = '16rem'; // 64 * 4px = 256px
                            sidebar.classList.remove('sidebar-collapsed');
                            
                            if (mainContent) {
                                mainContent.style.marginLeft = '16rem';
                                mainContent.classList.add('sm:ml-64');
                            }
                            if (footer) {
                                footer.style.marginLeft = '16rem';
                                footer.classList.add('sm:ml-64');
                            }
                            
                            // Animate content contraction
                            animateContent(false);
                            
                            setTimeout(() => {
                                sidebarTexts.forEach(text => {
                                    text.style.opacity = '1';
                                    text.style.visibility = 'visible';
                                });
                            }, 200); // Wait for sidebar expansion
                        }
                    } else {
                        // Mobile behavior - standard slide in/out
                        if (isCollapsed) {
                            sidebar.classList.add('-translate-x-full');
                        } else {
                            sidebar.classList.remove('-translate-x-full');
                        }
                        
                        // Reset text visibility on mobile
                        sidebarTexts.forEach(text => {
                            text.style.opacity = '1';
                            text.style.visibility = 'visible';
                        });
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 640) {
                    // Reset to proper desktop state
                    sidebar.classList.remove('-translate-x-full');
                    
                    if (!isCollapsed) {
                        sidebar.style.width = '16rem';
                        sidebar.classList.remove('sidebar-collapsed');
                        
                        if (mainContent) {
                            mainContent.style.marginLeft = '16rem';
                            mainContent.classList.add('sm:ml-64');
                        }
                        if (footer) {
                            footer.style.marginLeft = '16rem';
                            footer.classList.add('sm:ml-64');
                        }
                        
                        sidebarTexts.forEach(text => {
                            text.style.opacity = '1';
                            text.style.visibility = 'visible';
                        });
                    } else {
                        sidebar.style.width = '80px';
                        sidebar.classList.add('sidebar-collapsed');
                        
                        if (mainContent) {
                            mainContent.style.marginLeft = '80px';
                        }
                        if (footer) {
                            footer.style.marginLeft = '80px';
                        }
                        
                        sidebarTexts.forEach(text => {
                            text.style.opacity = '0';
                            text.style.visibility = 'hidden';
                        });
                    }
                } else {
                    // Mobile: reset inline styles and use classes
                    sidebar.style.width = '';
                    sidebar.classList.remove('sidebar-collapsed');
                    
                    if (mainContent) {
                        mainContent.style.marginLeft = '';
                        mainContent.classList.add('sm:ml-64');
                    }
                    if (footer) {
                        footer.style.marginLeft = '';
                        footer.classList.add('sm:ml-64');
                    }
                    
                    sidebarTexts.forEach(text => {
                        text.style.opacity = '1';
                        text.style.visibility = 'visible';
                    });
                    
                    // Ensure sidebar is hidden on mobile if collapsed
                    if (isCollapsed) {
                        sidebar.classList.add('-translate-x-full');
                    }
                }
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 640 && !isCollapsed) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickOnToggleButton = Array.from(toggleButtons).some(btn => btn.contains(event.target));
                    
                    if (!isClickInsideSidebar && !isClickOnToggleButton) {
                        sidebar.classList.add('-translate-x-full');
                        isCollapsed = true;
                    }
                }
            });
        });
    </script>

    <!-- Advanced Tooltip Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tooltip = null;
            
            // Create tooltip element
            function createTooltip() {
                if (!tooltip) {
                    tooltip = document.createElement('div');
                    tooltip.className = 'tooltip';
                    document.body.appendChild(tooltip);
                }
                return tooltip;
            }
            
            // Show tooltip
            function showTooltip(element, text) {
                const sidebar = document.getElementById('top-bar-sidebar');
                const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
                
                // Only show tooltip when sidebar is collapsed
                if (!isCollapsed) return;
                
                createTooltip();
                tooltip.textContent = text;
                tooltip.classList.remove('hidden-expanded');
                
                // Get element position
                const rect = element.getBoundingClientRect();
                const tooltipRect = tooltip.getBoundingClientRect();
                
                // Calculate position - place to the right of the icon with some offset
                const left = rect.right + 15; // 15px offset from icon
                const top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
                
                // Adjust if tooltip would go off screen
                const maxLeft = window.innerWidth - tooltipRect.width - 10;
                const maxTop = window.innerHeight - tooltipRect.height - 10;
                
                tooltip.style.left = Math.min(left, maxLeft) + 'px';
                tooltip.style.top = Math.max(10, Math.min(top, maxTop)) + 'px';
                
                // Show tooltip
                requestAnimationFrame(() => {
                    tooltip.classList.add('show');
                });
            }
            
            // Hide tooltip
            function hideTooltip() {
                if (tooltip) {
                    tooltip.classList.remove('show');
                }
            }
            
            // Add event listeners to all tooltip containers
            const tooltipElements = document.querySelectorAll('[data-tooltip]');
            
            tooltipElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    const text = this.getAttribute('data-tooltip');
                    showTooltip(this, text);
                });
                
                element.addEventListener('mouseleave', hideTooltip);
            });
            
            // Hide tooltip when sidebar expands
            const sidebar = document.getElementById('top-bar-sidebar');
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
                        if (!isCollapsed && tooltip) {
                            tooltip.classList.add('hidden-expanded');
                            hideTooltip();
                        } else if (tooltip) {
                            tooltip.classList.remove('hidden-expanded');
                        }
                    }
                });
            });
            
            observer.observe(sidebar, {
                attributes: true,
                attributeFilter: ['class']
            });
            
            // Hide tooltip on scroll
            window.addEventListener('scroll', hideTooltip);
            
            // Hide tooltip on window resize
            window.addEventListener('resize', hideTooltip);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>