<?php

namespace App\Services;

use App\Partner;

/**
 * Class PartnerService
 *
 * @package App\Services
 *
 * @author Aleksandr Gavva
 */
class PartnerService
{
    /**
     * Список партнеров
     *
     * @return mixed
     */
    public function getPartners()
    {
        return Partner::orderBy('name')
            ->get();
    }
}
