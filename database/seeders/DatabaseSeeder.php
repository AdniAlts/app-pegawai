<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a department
        $department = Department::create([
            'nama_departemen' => 'IT Department',
        ]);

        // Create a position with salary
        $position = Position::create([
            'nama_jabatan' => 'Software Developer',
            'gaji_pokok' => 5000000, // Rp 5.000.000
        ]);

        // Create an employee
        $employee = Employee::create([
            'nama_lengkap' => 'John Doe',
            'email' => 'john.doe@example.com',
            'nomor_telepon' => '081234567890',
            'tanggal_lahir' => '1990-01-15',
            'alamat' => 'Jl. Contoh No. 123',
            'tanggal_masuk' => '2023-01-01',
            'departemen_id' => $department->id,
            'jabatan_id' => $position->id,
            'status' => 'aktif',
        ]);

        // Create admin user
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'pegawai_id' => null, // Admin tidak terikat dengan employee tertentu
        ]);

        // Create user for the employee
        User::create([
            'username' => 'johndoe',
            'password' => Hash::make('password123'),
            'pegawai_id' => $employee->id,
        ]);

        // Run the attendance seeder
        $this->call([
            AttendanceSeeder::class,
        ]);
    }
}