<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarWash extends Model
{
    use HasFactory;

    protected $table = 'car_washes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $dateformat = 'Y-m-d H:i:s';

    protected $fillable = ['name' , 'phonenumber' , 'washtype' , 'start_time' , 'end_time'  , 'code'];




}
