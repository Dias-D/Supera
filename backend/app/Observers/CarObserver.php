<?php

namespace App\Observers;

use App\Models\Car;
use App\Models\Maintenance;
use Illuminate\Support\Str;

class CarObserver
{
    /**
     * Handle the Car "creating" event.
     *
     * @param  \App\Models\Car  $Car
     * @return void
     */
    public function creating(Car $car)
    {
        $car->id = Str::uuid();
    }

    /**
     * Handle the Car "created" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function created(Car $car)
    {
        //
    }

    /**
     * Handle the Car "updated" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function updated(Car $car)
    {
        //
    }

    /**
     * Handle the Car "deleting" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function deleting(Car $car)
    {
        $maintenanceIds = $car->maintenances()->pluck('id')->toArray();
        Maintenance::destroy($maintenanceIds);
    }

    /**
     * Handle the Car "deleted" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function deleted(Car $car)
    {
        $maintenanceIds = $car->maintenances()->pluck('id')->toArray();
        Maintenance::destroy($maintenanceIds);
    }

    /**
     * Handle the Car "restored" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function restored(Car $car)
    {
        //
    }

    /**
     * Handle the Car "force deleted" event.
     *
     * @param  \App\Models\Car  $car
     * @return void
     */
    public function forceDeleted(Car $car)
    {
        //
    }
}
