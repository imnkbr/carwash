<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WashType extends Model
{
    use HasFactory;

    protected $table = 'wash_type';

    protected $primaryKey = 'id';

    protected $fillable =['washtype','cost','duration'];

    public function reserveTimes()
    {
        return $this->hasMany(ReserveTime::class);
    }
}
