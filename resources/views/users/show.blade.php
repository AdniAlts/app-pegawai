@extends('master')
@section('title', 'Detail User')
@section('page-title', 'Detail User')
@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Detail User</h2>
            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                Kembali
            </a>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Username</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $user->username }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Pegawai</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">
                            {{ $user->employee ? $user->employee->nama_lengkap : 'Tidak ada' }}
                        </p>
                    </div>

                    @if($user->employee)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email Pegawai</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $user->employee->email }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500">Nomor Telepon</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $user->employee->nomor_telepon }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500">Departemen</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">
                            {{ $user->employee->department ? $user->employee->department->nama_departemen : 'Tidak ada' }}
                        </p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500">Posisi/Jabatan</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">
                            {{ $user->employee->position ? $user->employee->position->nama_jabatan : 'Tidak ada' }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('users.edit', $user->id) }}" 
               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                Edit
            </a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
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