<?php

namespace App\Http\Services;

use App\Http\Resources\MaintenanceResource;
use App\Http\Services\CarService;
use App\Models\Maintenance;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MaintenanceService
{
    protected $carService;

    public function __construct()
    {
        $this->carService = new CarService();
    }

    public function create(array $validated)
    {
        try {
            $car = $this->carService->getCarById($validated['car_id']);

            if (!$car->all() && $car->user_id != Auth::user()['id']) {
                return response()->json([
                    'success'       => false,
                    'maintenance'   => [],
                    'message'       => 'This car does not belong to the user',
                ], Response::HTTP_FORBIDDEN);
            }

            $maintenanceCreated = Maintenance::create($validated);

            $maintenance = Maintenance::where([
                'car_id'        => $maintenanceCreated['car_id'],
                'type'          => $maintenanceCreated['type'],
                'start_date'    => $maintenanceCreated['start_date']
            ])->first();

            return response()->json([
                'success'       => true,
                'maintenance'   => new MaintenanceResource($maintenance),
                'message'       => 'Maintenance\'s Car Created In Successfully!',
            ], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message'   => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($maintenanceId)
    {
        $maintenance = Maintenance::where('id', $maintenanceId)->first();

        if ($maintenance == null) {
            return response()->json([
                'success'       => false,
                'maintenance'   => [],
                'message'       => 'Maintenance\'s Car not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $car = $maintenance->car()->first();

        $this->isUser($car->user_id);

        $maintenance->delete();

        return response()->json([
            'success'       => true,
            'maintenance'   => [],
            'message'       => 'Maintenance deleted in successfully',
        ], Response::HTTP_OK);
    }

    public function get($maintenanceId)
    {
        $maintenance = Maintenance::where('id', $maintenanceId)->first();

        if ($maintenance == null) {
            return response()->json([
                'success'       => false,
                'maintenance'   => [],
                'message'       => 'Maintenance\'s Car not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $car = $maintenance->car()->first();

        $this->isUser($car->user_id);

        return response()->json([
            'success'       => true,
            'maintenances'  => new MaintenanceResource($maintenance),
            'message'       => 'Maintenance\'s Car found successfully'
        ], Response::HTTP_OK);
    }

    public function getAllByCar(string $carId)
    {
        $car = $this->carService->getCarById($carId);

        if (!$car->all() && $car->user_id != Auth::user()['id']) {
            return response()->json([
                'success'       => false,
                'maintenance'   => [],
                'message'       => 'This car does not belong to the user',
            ], Response::HTTP_FORBIDDEN);
        }

        $maintenances = Maintenance::where('car_id', $carId)->get();

        if (!$maintenances->all()) {
            return response()->json([
                'success'       => true,
                'maintenances'  => [],
                'message'       => 'There are no maintenance for this car'
            ], Response::HTTP_NO_CONTENT);
        }

        return response()->json([
            'success'       => true,
            'maintenances'  => MaintenanceResource::collection($maintenances),
            'message'       => 'All maintenances by this car'
        ], Response::HTTP_OK);
    }

    public function update(array $validated, string $maintenanceId)
    {
        try {
            $maintenance = Maintenance::where('id', $maintenanceId)->first();

            if ($maintenance == null) {
                return response()->json([
                    'success'       => false,
                    'maintenance'   => [],
                    'message'       => 'Maintenance\'s Car not found',
                ], Response::HTTP_NOT_FOUND);
            }

            $car = $maintenance->car()->first();

            $this->isUser($car->user_id);

            $maintenance->update($validated);

            return response()->json([
                'success'       => true,
                'maintenance'   => new MaintenanceResource($maintenance),
                'message'       => 'Maintenance\'s Car Updated In Successfully!',
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message'   => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function isUser(string $userId)
    {
        if ($userId != Auth::user()['id']) {
            return response()->json([
                'success'   => false,
                'car'       => [],
                'message'   => 'This car does not belong to the user',
            ], Response::HTTP_FORBIDDEN);
        }

        return;
    }
}
