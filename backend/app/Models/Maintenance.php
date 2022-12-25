<?php

namespace App\Models;

use App\Observers\MaintenanceObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    protected $keyType = 'string';

    protected $fillable = [
        'car_id',
        'type',
        'description',
        'start_date',
        'end_date',
        'status'
    ];

    protected $observers = [
        Maintenance::class => [MaintenanceObserver::class],
    ];
}
