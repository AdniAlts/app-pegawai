<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'pegawai_id' => null, // Admin tidak terikat dengan employee tertentu
        ]);

        // Jika ada employee, buat user untuk employee pertama
        $firstEmployee = Employee::first();
        if ($firstEmployee) {
            User::create([
                'username' => 'employee',
                'password' => Hash::make('employee123'),
                'pegawai_id' => $firstEmployee->id,
            ]);
        }
    }
}