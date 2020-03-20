<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

/**
 * Class WeatherController
 *
 * @package App\Http\Controllers
 *
 * @author Aleksandr Gavva
 */
class WeatherController extends Controller
{
    /**
     * @var WeatherService
     */
    private $weatherService;

    /**
     * WeatherController constructor
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * Погода в городе
     *
     * @return string
     */
    public function weather($id)
    {
        $weather = $this->weatherService->getByCity($id);
        return view('weather', compact(['weather']));
    }
}
