@extends('master')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Dashboard</h1>
            <p class="text-gray-600">Welcome to App Pegawai - Employee Management System</p>
        </div>

        <!-- Cards Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Card 1: Employee Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.196-2.121l-.007.006a3 3 0 00-1.8 2.115zM9 20H4v-2a3 3 0 015.196-2.121l.007.006a3 3 0 011.8 2.115zM21 10h-3.5a2 2 0 01-2-2V5.5a2 2 0 012-2H21m0 6.5V19a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h5.5a2 2 0 012 2V8a2 2 0 002 2H21z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-white">Employee Information</h3>
                        </div>
                        <a href="{{ url('/employees') }}"
                            class="inline-flex items-center px-3 py-1 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <span>View All</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Employee::count() }}</p>
                            <p class="text-sm text-gray-600">Total Employees</p>
                        </div>
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Employee Stats -->
                    <div class="mb-4">
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\Employee::whereNotNull('departemen_id')->count() }}</p>
                            <p class="text-xs text-gray-600">Active</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex space-x-3">
                        <a href="{{ url('/employees/create') }}"
                            class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium text-center transition-colors duration-200">
                            Add Employee
                        </a>
                        <a href="{{ url('/employees') }}"
                            class="flex-1 bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium text-center transition-colors duration-200">
                            Manage All
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Departments List -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <!-- Card Header -->
                <div class="bg-green-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <h3 class="text-lg font-semibold text-white">Departments</h3>
                        </div>
                        <a href="{{ url('/departments') }}"
                            class="inline-flex items-center px-3 py-1 bg-white/20 hover:bg-white/30 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <span>View All</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Department::count() }}</p>
                            <p class="text-sm text-gray-600">Total Departments</p>
                        </div>
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>

                    <!-- Department List -->
                    <div class="space-y-2 mb-4 max-h-40 overflow-y-auto">
                        @forelse(\App\Models\Department::limit(5)->get() as $department)
                            <div
                                class="flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-3"></div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $department->nama_departemen }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-green-600">{{ $department->employees()->count() }}
                                    </p>
                                    <p class="text-xs text-gray-500">employees</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <p class="text-gray-500 text-sm">No departments found</p>
                                <a href="{{ url('/departments/create') }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">Create your first
                                    department</a>
                            </div>
                        @endforelse

                        @if (\App\Models\Department::count() > 5)
                            <div class="text-center pt-2">
                                <a href="{{ url('/departments') }}"
                                    class="text-green-600 hover:text-green-800 text-sm font-medium">
                                    +{{ \App\Models\Department::count() - 5 }} more departments
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex space-x-3">
                        <a href="{{ url('/departments/create') }}"
                            class="flex-1 bg-green-50 hover:bg-green-100 text-green-700 px-4 py-2 rounded-lg text-sm font-medium text-center transition-colors duration-200">
                            Add Department
                        </a>
                        <a href="{{ url('/departments') }}"
                            class="flex-1 bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium text-center transition-colors duration-200">
                            Manage All
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
