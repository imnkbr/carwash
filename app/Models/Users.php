<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['role_id', 'name' , 'phone_number' , 'email' , 'password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function assignRole($role)
    {
        return $this->role()->save(
            Role::where('name', $role)->firstOrFail()
        );
    }

    public function reserveTimes()
    {
        return $this->hasMany(ReserveTime::class);
    }
}
