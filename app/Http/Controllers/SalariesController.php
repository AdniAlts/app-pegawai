<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salaries;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salaries::with('employee')->latest()->paginate(5);
        $employees = Employee::with('position')->get();
        return view('salaries.index', compact('salaries', 'employees'));
    }

    /**
     * Generate salary for an employee based on attendance.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date_format:Y-m',
        ]);

        $employee = Employee::with('position')->findOrFail($request->karyawan_id);
        $bulan = $request->bulan;

        // Parse the month to get start and end dates
        $startDate = Carbon::createFromFormat('Y-m', $bulan)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $bulan)->endOfMonth();

        // Get all attendance records for this employee in the selected month
        $attendances = Attendance::where('karyawan_id', $employee->id)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->where('status_absensi', 'hadir')
            ->get();

        // Get base salary from position
        $gajiPokok = $employee->position->gaji_pokok ?? 0;

        // Calculate hourly wage (1/173 of monthly salary)
        $upahSejam = $gajiPokok / 173;

        // Work start time is 09:00
        $jamMasuk = Carbon::createFromFormat('H:i:s', '09:00:00');

        $totalPotongan = 0;
        $totalMenitTerlambat = 0;

        foreach ($attendances as $attendance) {
            if ($attendance->waktu_masuk) {
                $waktuMasuk = Carbon::createFromFormat('H:i:s', $attendance->waktu_masuk);
                
                // Calculate minutes late
                if ($waktuMasuk->gt($jamMasuk)) {
                    $menitTerlambat = $jamMasuk->diffInMinutes($waktuMasuk);
                    $totalMenitTerlambat += $menitTerlambat;
                    
                    // Potongan gaji = (Jumlah menit keterlambatan / 60) × upah sejam
                    $potongan = ($menitTerlambat / 60) * $upahSejam;
                    $totalPotongan += $potongan;
                }
            }
        }

        // Tunjangan (can be customized, using 0 for now)
        $tunjangan = 0;

        // Total gaji
        $totalGaji = $gajiPokok + $tunjangan - $totalPotongan;

        // Check if salary record already exists for this employee and month
        $existingSalary = Salaries::where('karyawan_id', $employee->id)
            ->where('bulan', $bulan)
            ->first();

        if ($existingSalary) {
            $existingSalary->update([
                'gaji_pokok' => $gajiPokok,
                'tunjangan' => $tunjangan,
                'potongan' => round($totalPotongan, 2),
                'total_gaji' => round($totalGaji, 2),
            ]);
            $message = 'Gaji berhasil diperbarui!';
        } else {
            Salaries::create([
                'karyawan_id' => $employee->id,
                'bulan' => $bulan,
                'gaji_pokok' => $gajiPokok,
                'tunjangan' => $tunjangan,
                'potongan' => round($totalPotongan, 2),
                'total_gaji' => round($totalGaji, 2),
            ]);
            $message = 'Gaji berhasil digenerate!';
        }

        return redirect()->route('salaries.index')->with('success', $message . ' Total keterlambatan: ' . $totalMenitTerlambat . ' menit.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
            'potongan' => 'required|numeric',
            'total_gaji' => 'required|numeric',
        ]);
        Salaries::create($request->all());
        return redirect()->route('salaries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salary = Salaries::find($id);
        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salary = Salaries::find($id);
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
            'potongan' => 'required|numeric',
            'total_gaji' => 'required|numeric',
        ]);
        $salary = Salaries::findOrFail($id);
        $salary->update($request->only([
            'karyawan_id',
            'bulan',
            'gaji_pokok',
            'tunjangan',
            'potongan',
            'total_gaji',
        ]));
        return redirect()->route('salaries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salary = Salaries::findOrFail($id);
        $salary->delete();
        return redirect()->route('salaries.index');
    }
}
