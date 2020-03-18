<?php

namespace App\DTO;

use App\Common\Objects\DTO;

/**
 * Class OpenWeatherMapDTO
 *
 * @package App\DTO
 *
 * @author Aleksandr Gavva
 */
class OpenWeatherMapDTO extends DTO implements WeatherDTOInterface
{
    /**
     * Сопоставление облачности
     */
    const CLOUDS = [
        'ясно' => [
            'min' => 0,
            'max' => 25,
        ],
        'малооблачно' => [
            'min' => 26,
            'max' => 50,
        ],
        'облачно' => [
            'min' => 51,
            'max' => 75,
        ],
        'пасмурно' => [
            'min' => 76,
            'max' => 100,
        ],
    ];

    /**
     * json-string
     * @var string
     */
    private $source;
    /* @var float */
    private $temp;
    /* @var string */
    private $desc;
    /* @var float */
    private $windSpeed;
    /* @var int */
    private $windDirection;
    /* @var int */
    private $clouds;

    /**
     * OpenWeatherMapDTO constructor.
     */
    public function __construct($data)
    {
        //TODO использовать JSON_THROW_ON_ERROR в PHP >=7.3
        $this->source = json_decode($data);
        if (json_last_error()) {
            throw new \JsonException('Ошибка декодирования JSON', json_last_error());
        }
        $this->temp = $this->source->main->temp - 273.15;
        $this->desc = $this->source->weather[0]->description;
        $this->windSpeed = $this->source->wind->speed;
        $this->windDirection = $this->source->wind->deg;
        foreach (self::CLOUDS as $cloud => $conditions) {
            if ($this->source->clouds->all >= $conditions['min'] && $this->source->clouds->all <= $conditions['max']) {
                $this->clouds = $cloud;
                break;
            }
        }
    }

    /** @inheritDoc */
    public function getTemperature()
    {
        return $this->temp;
    }

    /** @inheritDoc */
    public function getDescription()
    {
        return $this->desc;
    }

    /** @inheritDoc */
    public function getWindSpeed()
    {
        return $this->windSpeed;
    }

    /** @inheritDoc */
    public function getWindDirection()
    {
        return $this->windDirection;
    }

    /** @inheritDoc */
    public function getClouds()
    {
        return $this->clouds;
    }
}
