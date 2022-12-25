<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Services\CarService;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    protected $carService;

    public function __construct()
    {
        $this->carService = new CarService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->carService->getAll(Auth::user()['id']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $validated = $request->validated();

        return $this->carService->create($validated, Auth::user()['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(string $carId)
    {
        return $this->carService->get($carId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, string $carId)
    {
        $validated = $request->validated();

        return $this->carService->update($validated, $carId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $carId)
    {
        return $this->carService->delete($carId);
    }
}
