<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 *
 * @package App
 *
 * @property string email
 * @property string name
 * @property Collection products
 *
 * @author Aleksandr Gavva
 */
class Vendor extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
