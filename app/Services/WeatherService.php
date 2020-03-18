<?php

namespace App\Services;

use App\DTO\WeatherDTOInterface;
use App\Repositories\WeatherRepositoryInterface;
use Illuminate\Contracts\Cache\Repository as Cache;

/**
 * Class WeatherService
 *
 * @package App\Services
 *
 * @author Aleksandr Gavva
 */
class WeatherService
{
    const CACHE_PREFIX = 'weather';
    /**
     * время в минутах
     */
    const CACHE_TIME = 5;

    /**
     * @var WeatherRepositoryInterface
     */
    private $repository;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * WeatherService constructor.
     *
     * @param WeatherRepositoryInterface $weatherRepository
     * @param Cache $cache
     */
    public function __construct(
        WeatherRepositoryInterface $weatherRepository,
        Cache $cache
    ) {
        $this->repository = $weatherRepository;
        $this->cache = $cache;
    }

    /**
     * @param $id
     * @return string
     */
    private function getCacheKeyByCity($id)
    {
        return self::CACHE_PREFIX . $id;
    }

    /**
     * @param int $id
     * @return WeatherDTOInterface
     */
    public function getByCity($id)
    {
        return $this->cache->remember($this->getCacheKeyByCity($id), self::CACHE_TIME, function () use ($id) {
            return $this->repository->getByCity($id);
        });
    }
}
