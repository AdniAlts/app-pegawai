@extends('master')
@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Pegawai')
@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Detail Pegawai</h2>
            <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Personal Information -->
            <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Personal</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $employee->nama_lengkap }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $employee->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nomor Telepon</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $employee->nomor_telepon }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $employee->tanggal_lahir }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employment Information -->
            <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kepegawaian</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Departemen</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $employee->department->nama_departemen }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jabatan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $employee->position->nama_jabatan }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Masuk</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $employee->tanggal_masuk }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status</label>
                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $employee->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $employee->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Alamat</h3>
                    <p class="text-sm text-gray-900">{{ $employee->alamat }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('employees.edit', $employee->id) }}" 
               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                Edit
            </a>
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg"
                        onclick="return confirm('Yakin ingin menghapus?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection