<?php

namespace App\Http\Services;

use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CarService
{
    public function create(array $request, string $userId)
    {
        try {
            $carCreated = Car::create([
                'user_id'   => $userId,
                'name'      => $request['name'],
                'brand'     => $request['brand'],
                'model'     => $request['model'],
                'version'   => $request['version']
            ]);

            $car = Car::where([
                'user_id'   => $carCreated['user_id'],
                'name'      => $carCreated['name'],
                'brand'     => $carCreated['brand']
            ])->first();

            return response()->json([
                'success'   => true,
                'car'       => new CarResource($car),
                'message'   => 'Car Created In Successfully!',
            ], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message'   => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get($carId)
    {
        $car = Car::where('id', $carId)->first();

        if ($car == null) {
            return response()->json([
                'success'   => false,
                'car'       => [],
                'message'   => 'Car not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $this->isUser($car->user_id);

        return response()->json([
            'success'   => true,
            'cars'      => new CarResource($car),
            'message'   => 'Car found successfully'
        ], Response::HTTP_OK);
    }

    public function getAll(string $userId)
    {
        $cars = Car::where('user_id', $userId)->get();

        if (!$cars->all()) {
            return response()->json([
                'success'   => true,
                'cars'      => [],
                'message'   => 'There are no cars for this user'
            ], Response::HTTP_NO_CONTENT);
        }

        return response()->json([
            'success'   => true,
            'cars'      => CarResource::collection($cars),
            'message'   => 'All cars by this user'
        ], Response::HTTP_OK);
    }

    public function getCarById(string $carId)
    {
        $car = Car::where('id', $carId)->first();

        if ($car == null) {
            return response()->json([
                'success'   => false,
                'car'       => [],
                'message'   => 'Car not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success'   => true,
            'cars'      => new CarResource($car),
            'message'   => 'Car found successfully'
        ], Response::HTTP_OK);
    }

    public function update(array $request, string $carId)
    {
        try {
            $car = Car::where('id', $carId)->first();

            if ($car == null) {
                return response()->json([
                    'success'   => false,
                    'car'       => [],
                    'message'   => 'Car not found',
                ], Response::HTTP_NOT_FOUND);
            }

            $this->isUser($car->user_id);

            $car->update($request);

            return response()->json([
                'success'   => true,
                'car'       => new CarResource($car),
                'message'   => 'Car Updated In Successfully!',
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message'   => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($carId)
    {
        $car = Car::where('id', $carId)->first();

        if ($car == null) {
            return response()->json([
                'success'   => false,
                'car'       => [],
                'message'   => 'Car not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $this->isUser($car->user_id);

        $car->delete();

        return response()->json([
            'success'   => true,
            'car'       => [],
            'message'   => 'Car deleted in successfully',
        ], Response::HTTP_OK);
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
