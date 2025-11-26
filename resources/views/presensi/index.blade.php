@extends('master')
@section('title', 'Presensi')
@section('page-title', 'Presensi Pegawai')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-bold mb-4">Presensi Hari Ini: {{ \Carbon\Carbon::now()->format('d F Y') }}</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            <div class="flex flex-col items-center justify-center space-y-4">
                @if(!$attendance)
                    <div class="text-center">
                        <p class="mb-2 text-gray-600">Anda belum melakukan presensi masuk hari ini.</p>
                        <form action="{{ route('presensi.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Presensi Masuk
                            </button>
                        </form>
                    </div>
                @elseif(!$attendance->waktu_keluar)
                    <div class="text-center">
                        <p class="mb-2 text-gray-600">Waktu Masuk: <span class="font-semibold">{{ $attendance->waktu_masuk }}</span></p>
                        <p class="mb-2 text-gray-600">Silakan lakukan presensi keluar jika sudah selesai bekerja.</p>
                        <form action="{{ route('presensi.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Presensi Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="text-center">
                        <p class="mb-2 text-gray-600">Waktu Masuk: <span class="font-semibold">{{ $attendance->waktu_masuk }}</span></p>
                        <p class="mb-2 text-gray-600">Waktu Keluar: <span class="font-semibold">{{ $attendance->waktu_keluar }}</span></p>
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg">
                            Anda sudah menyelesaikan presensi hari ini.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
