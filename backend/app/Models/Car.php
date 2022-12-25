<?php

namespace App\Models;

use App\Observers\CarObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'model',
        'version'
    ];

    protected $observers = [
        Car::class => [CarObserver::class],
    ];
}
