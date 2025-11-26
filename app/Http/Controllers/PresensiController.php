<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        $attendance = Attendance::where('karyawan_id', $user->pegawai_id)
            ->where('tanggal', $today)
            ->first();

        return view('presensi.index', compact('attendance'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = Carbon::now();

        $attendance = Attendance::where('karyawan_id', $user->pegawai_id)
            ->where('tanggal', $today)
            ->first();

        if (!$attendance) {
            // Check in
            Attendance::create([
                'karyawan_id' => $user->pegawai_id,
                'tanggal' => $today,
                'waktu_masuk' => $now,
                'status_absensi' => 'hadir', // Default status
            ]);
            return redirect()->back()->with('success', 'Berhasil melakukan presensi masuk.');
        } elseif (!$attendance->waktu_keluar) {
            // Check out
            $attendance->update([
                'waktu_keluar' => $now,
            ]);
            return redirect()->back()->with('success', 'Berhasil melakukan presensi keluar.');
        } else {
            return redirect()->back()->with('info', 'Anda sudah melakukan presensi hari ini.');
        }
    }
}
