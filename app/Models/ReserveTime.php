<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveTime extends Model
{
    use HasFactory;

    protected $table = 'reserve_times';

    protected $primaryKey = 'id';

    protected $dateformat = 'Y-m-d H:i:s';

    protected $fillable = ['start_time','end_time','user_id','wash_type_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function washType()
    {
        return $this->belongsTo(WashType::class);
    }
}
