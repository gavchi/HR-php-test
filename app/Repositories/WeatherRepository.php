<?php

namespace App\Repositories;

use App\Common\Repositories\Repository;
use App\DTO\OpenWeatherMapDTO;
use App\DTO\WeatherDTOInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * Class WeatherRepository
 *
 * @package App\Repositories
 *
 * @author Aleksandr Gavva
 */
class WeatherRepository extends Repository implements WeatherRepositoryInterface
{
    /**
     * @param $id
     * @return WeatherDTOInterface
     * @throws \JsonException
     */
    public function getByCity($id)
    {
        /*
        TODO
        в реальности тут может быть сопоставление внутреннего id города с id города какого-либо сервиса
        и селектор сервиса в зависимости от его доступности
        */
        return $this->getFromOpenWeatherMap($id);
    }

    /**
     * @param $id
     * @return WeatherDTOInterface
     * @throws \JsonException
     */
    private function getFromOpenWeatherMap($id)
    {
        $client = new Client();
        $result = $client->get('api.openweathermap.org/data/2.5/weather?id=571476&lang=ru&appid=af206196a98b6a1e79f5619dde3dd8a9');
        return new OpenWeatherMapDTO($result->getBody()->getContents());
    }

}
