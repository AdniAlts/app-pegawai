@extends('master')
@section('title', 'Edit Jabatan')
@section('page-title', 'Edit Jabatan')
@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Edit Jabatan</h2>
            <a href="{{ route('positions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                Kembali
            </a>
        </div>

        <form action="{{ route('positions.update', $position->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="max-w-xl space-y-6">
                <div>
                    <label for="nama_jabatan" class="block text-sm font-medium text-gray-700">Nama Jabatan</label>
                    <input type="text" id="nama_jabatan" name="nama_jabatan" 
                           value="{{ old('nama_jabatan', $position->nama_jabatan) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nama_jabatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="gaji_pokok" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <input type="number" id="gaji_pokok" name="gaji_pokok" 
                               value="{{ old('gaji_pokok', $position->gaji_pokok) }}"
                               class="pl-12 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    @error('gaji_pokok')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection