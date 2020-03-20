<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 *
 * @property string name
 * @property int price
 * @property int vendor_id
 * @property Vendor vendor
 * @property Collection orders
 *
 * @author Aleksandr Gavva
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'vendor_id', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_products');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
}
