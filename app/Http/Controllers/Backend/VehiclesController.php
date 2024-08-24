<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CarApiService;

class VehiclesController extends Controller
{
    protected CarApiService $carApiService;

    public function __construct(CarApiService $carApiService)
    {
        $this->carApiService = $carApiService;
    }

    public function index()
    {
        $years = $this->carApiService->getVehicleYears();

        dd($years);

        try {
            $years = $this->carApiService->getVehicleYears();
            $makes = !empty($years) ? $this->carApiService->getVehicleMakes($years[0]) : [];
            $models = !empty($makes) ? $this->carApiService->getVehicleModels($years[0], $makes[0]) : [];
            return view('backend.Vehicles.index', compact('years', 'makes', 'models'));
        } catch (\Exception $e) {
            return view('backend.Vehicles.index')->with('error', 'Error fetching data: ' . $e->getMessage());
        }
    }
}
