<?php

namespace App\Repositories;

use App\DTO\WeatherDTOInterface;

/**
 * Interface WeatherRepositoryInterface
 *
 * @package App\Repositories
 *
 * @author Aleksandr Gavva
 */
interface WeatherRepositoryInterface
{
    /**
     * @param int $id
     * @return WeatherDTOInterface
     */
    public function getByCity($id);
}
