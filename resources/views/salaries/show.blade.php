@extends('master')
@section('title', 'Detail Gaji')
@section('page-title', 'Detail Gaji')
@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Detail Gaji</h2>
            <a href="{{ route('salaries.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                Kembali
            </a>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Karyawan Info -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Karyawan</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $salary->employee->nama_lengkap }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Bulan</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $salary->bulan }}</p>
                    </div>
                </div>

                <!-- Salary Details -->
                <div class="space-y-4">
                    <div class="border-b border-gray-200 pb-4">
                        <label class="text-sm font-medium text-gray-500">Gaji Pokok</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <label class="text-sm font-medium text-gray-500">Tunjangan</label>
                        <p class="mt-1 text-lg font-medium text-blue-600">+ Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</p>
                    </div>

                    <div class="border-b border-gray-200 pb-4">
                        <label class="text-sm font-medium text-gray-500">Potongan</label>
                        <p class="mt-1 text-lg font-medium text-red-600">- Rp {{ number_format($salary->potongan, 0, ',', '.') }}</p>
                    </div>

                    <div class="pt-4">
                        <label class="text-sm font-medium text-gray-500">Total Gaji</label>
                        <p class="mt-1 text-xl font-bold text-green-600">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('salaries.edit', $salary->id) }}" 
               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                Edit
            </a>
            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline">
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