<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $table= 'residences';

    protected $fillable = [
        'title', 'city', 'start_date', 'end_date', 'capacity', 'price', 'type', 'is_available', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}
