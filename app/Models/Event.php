<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';


    protected $fillable = ['user_id', 'event', 'start_time', 'end_time', 'adresse', 'notes', 'type','telephone','mobile','email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'start_date' => 'datetime', // Cast start_date column to Carbon instance
        'end_date' => 'datetime',   // Cast end_date column to Carbon instance
    ];
}
