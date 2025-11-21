<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'password',
        'pegawai_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'pegawai_id');
    }
}
