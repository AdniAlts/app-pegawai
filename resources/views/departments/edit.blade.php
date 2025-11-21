@extends('master')
@section('title', 'Edit Departemen')
@section('page-title', 'Edit Departemen')
@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Edit Departemen</h2>
            <a href="{{ route('departments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                Kembali
            </a>
        </div>

        <form action="{{ route('departments.update', $department->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="max-w-xl">
                <label for="nama_departemen" class="block text-sm font-medium text-gray-700">Nama Departemen</label>
                <input type="text" id="nama_departemen" name="nama_departemen" 
                       value="{{ old('nama_departemen', $department->nama_departemen) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('nama_departemen')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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