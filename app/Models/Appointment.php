<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'dentist_id',
        'location_id',
        'appointment_time',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
