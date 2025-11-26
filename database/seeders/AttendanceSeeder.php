<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first employee (or create one if needed)
        $employee = Employee::first();

        if (!$employee) {
            return; // No employee to seed attendance for
        }

        // Start date: November 1, 2025
        $startDate = Carbon::create(2025, 11, 1);

        // Array of varied check-in times (some late, some on time)
        $checkInTimes = [
            '08:45:00', // Early
            '09:00:00', // On time
            '09:05:00', // 5 minutes late
            '09:15:00', // 15 minutes late
            '09:30:00', // 30 minutes late
            '08:55:00', // Early
            '09:10:00', // 10 minutes late
            '09:20:00', // 20 minutes late
            '08:50:00', // Early
            '09:03:00', // 3 minutes late
            '09:45:00', // 45 minutes late
            '09:00:00', // On time
            '08:58:00', // Early
            '09:12:00', // 12 minutes late
            '09:25:00', // 25 minutes late
            '08:52:00', // Early
            '09:08:00', // 8 minutes late
            '09:00:00', // On time
            '09:35:00', // 35 minutes late
            '08:48:00', // Early
            '09:18:00', // 18 minutes late
            '09:00:00', // On time
            '09:07:00', // 7 minutes late
            '08:59:00', // On time (1 min early)
            '09:22:00', // 22 minutes late
            '09:00:00', // On time
            '09:40:00', // 40 minutes late
            '08:47:00', // Early
            '09:02:00', // 2 minutes late
        ];

        // Array of varied check-out times
        $checkOutTimes = [
            '17:00:00',
            '17:15:00',
            '17:30:00',
            '17:05:00',
            '17:45:00',
            '17:20:00',
            '17:00:00',
            '17:10:00',
            '18:00:00',
            '17:25:00',
            '17:00:00',
            '17:35:00',
            '17:50:00',
            '17:00:00',
            '17:08:00',
            '17:40:00',
            '17:00:00',
            '17:22:00',
            '17:55:00',
            '17:00:00',
            '17:12:00',
            '17:30:00',
            '17:00:00',
            '17:18:00',
            '17:45:00',
            '17:00:00',
            '17:28:00',
            '17:00:00',
            '17:33:00',
        ];

        // Status options
        $statuses = ['hadir', 'hadir', 'hadir', 'hadir', 'hadir', 'izin', 'sakit']; // Mostly 'hadir'

        // Loop from November 1 to November 25
        for ($i = 0; $i < 25; $i++) {
            $date = $startDate->copy()->addDays($i);
            
            // Skip weekends
            if ($date->isWeekend()) {
                continue;
            }

            $status = $statuses[array_rand($statuses)];
            
            Attendance::create([
                'karyawan_id' => $employee->id,
                'tanggal' => $date->format('Y-m-d'),
                'waktu_masuk' => $status === 'hadir' ? $checkInTimes[$i % count($checkInTimes)] : null,
                'waktu_keluar' => $status === 'hadir' ? $checkOutTimes[$i % count($checkOutTimes)] : null,
                'status_absensi' => $status,
            ]);
        }
    }
}
