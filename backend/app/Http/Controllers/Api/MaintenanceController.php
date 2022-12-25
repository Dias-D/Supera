<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Http\Services\MaintenanceService;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    protected $maintenanceService;

    public function __construct()
    {
        $this->maintenanceService = new MaintenanceService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->maintenanceService->getAllByCar($request->input('car_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMaintenanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaintenanceRequest $request)
    {
        $validated = $request->validated();

        return $this->maintenanceService->create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(string $maintenanceId)
    {
        return $this->maintenanceService->get($maintenanceId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMaintenanceRequest  $request
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaintenanceRequest $request, string $maintenanceId)
    {
        $validated = $request->validated();

        return $this->maintenanceService->update($validated, $maintenanceId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $maintenanceId)
    {
        return $this->maintenanceService->delete($maintenanceId);
    }
}
