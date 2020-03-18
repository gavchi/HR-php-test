<?php

namespace App\DTO;

/**
 * Interface WeatherDTOInterface
 *
 * @package App\DTO
 *
 * @author Aleksandr Gavva
 */
interface WeatherDTOInterface
{
    /**
     * Температура в градусах Цельсия
     *
     * @return float
     */
    public function getTemperature();

    /**
     * Описание
     *
     * @return string
     */
    public function getDescription();

    /**
     * Скорость ветра м/с
     *
     * @return float
     */
    public function getWindSpeed();

    /**
     * Направление ветра в градусах
     *
     * @return int
     */
    public function getWindDirection();

    /**
     * Облачность
     *
     * @return string
     */
    public function getClouds();
}
