@extends('master')
@section('title', 'Detail Jabatan')
@section('page-title', 'Detail Jabatan')
@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Detail Jabatan</h2>
            <a href="{{ route('positions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                Kembali
            </a>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Jabatan</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $position->nama_jabatan }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Gaji Pokok</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('positions.edit', $position->id) }}" 
               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                Edit
            </a>
            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="inline">
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