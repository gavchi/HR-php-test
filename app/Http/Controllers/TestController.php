<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @var WeatherService
     */
    var $weatherService;

    /**
     * TestController constructor.
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @return string
     */
    public function weather($id)
    {
        $weather = $this->weatherService->getByCity($id);
        return view('weather', compact(['weather']));
    }
}
