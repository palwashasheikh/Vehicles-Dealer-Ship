<?php

namespace App\Services;

use CarApiSdk\CarApi;
use CarApiSdk\CarApiConfig;

class CarApiService
{
    private CarApi $carApi;

    public function __construct()
    {
        // Configure and initialize the CarApi instance
        $config = CarApiConfig::build([
            'token' => env('CAR_API_TOKEN'),
            'secret' => env('CAR_API_SECRET'),
            'host' => env('CAR_API_HOST'),
            'verify' => false,  // Disable SSL verification

        ]);
        $this->carApi = new CarApi($config);
    }

    /**
     * Get vehicle years.
     *
     * @return array
     */
    public function getVehicleYears(): array
    {

        return $this->carApi->years();
    }

    /**
     * Get vehicle makes based on the year.
     *
     * @param string $year
     * @return array
     */
    public function getVehicleMakes(string $year): array
    {
        return $this->carApi->makes(['query' => ['year' => $year]]);
    }

    /**
     * Get vehicle models based on the year and make.
     *
     * @param string $year
     * @param string $make
     * @return array
     */
    public function getVehicleModels(string $year, string $make): array
    {
        return $this->carApi->models(['query' => ['year' => $year, 'make' => $make]]);
    }
}
