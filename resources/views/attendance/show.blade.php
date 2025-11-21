@extends('master')
@section('title', 'Detail Kehadiran')
@section('page-title', 'Detail Kehadiran')
@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Detail Kehadiran</h2>
            <a href="{{ route('attendance.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                Kembali
            </a>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <!-- Karyawan Info -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Karyawan</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $attendance->employee->nama_lengkap }}</p>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tanggal</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Waktu -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Waktu Masuk</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $attendance->waktu_masuk }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500">Waktu Keluar</label>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $attendance->waktu_keluar }}</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status Absensi</label>
                        <p class="mt-1">
                            <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full 
                                {{ $attendance->status_absensi === 'hadir' ? 'bg-green-100 text-green-800' : 
                                   ($attendance->status_absensi === 'izin' ? 'bg-blue-100 text-blue-800' : 
                                    ($attendance->status_absensi === 'sakit' ? 'bg-yellow-100 text-yellow-800' : 
                                     ($attendance->status_absensi === 'terlambat' ? 'bg-orange-100 text-orange-800' : 
                                      'bg-red-100 text-red-800'))) }}">
                                {{ ucfirst($attendance->status_absensi) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('attendance.edit', $attendance->id) }}" 
               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                Edit
            </a>
            <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST" class="inline">
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