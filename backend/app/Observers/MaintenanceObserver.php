<?php

namespace App\Observers;

use App\Models\Maintenance;
use Illuminate\Support\Str;

class MaintenanceObserver
{
    /**
     * Handle the Maintenance "creating" event.
     *
     * @param  \App\Models\Maintenance  $Maintenance
     * @return void
     */
    public function creating(Maintenance $maintenance)
    {
        $maintenance->id = Str::uuid();
    }

    /**
     * Handle the Maintenance "created" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function created(Maintenance $maintenance)
    {
        //
    }

    /**
     * Handle the Maintenance "updated" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function updated(Maintenance $maintenance)
    {
        //
    }

    /**
     * Handle the Maintenance "deleted" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function deleted(Maintenance $maintenance)
    {
        //
    }

    /**
     * Handle the Maintenance "restored" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function restored(Maintenance $maintenance)
    {
        //
    }

    /**
     * Handle the Maintenance "force deleted" event.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return void
     */
    public function forceDeleted(Maintenance $maintenance)
    {
        //
    }
}
