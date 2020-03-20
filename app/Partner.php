<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Partner
 *
 * @package App
 *
 * @property string email
 * @property string name
 * @property Collection orders
 *
 * @author Aleksandr Gavva
 */
class Partner extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
