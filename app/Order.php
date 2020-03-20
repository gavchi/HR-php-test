<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @package App
 *
 * @property int status
 * @property string client_email
 * @property int partner_id
 * @property string delivery_dt
 * @property Collection products
 * @property Partner partner
 *
 * @author Aleksandr Gavva
 */
class Order extends Model
{
    const STATUS = [
        0 => 'NEW',
        10 => 'CONFIRMED',
        20 => 'COMPLETED',
    ];

    /** @var array  */
    protected $dates = [
        'created_at',
        'updated_at',
        'delivery_dt',
    ];

    /** @var array  */
    protected $fillable = ['client_email', 'partner_id', 'status'];

    /**
     * Получить доступные статусы
     *
     * @return array
     */
    public static function getAvailableStatuses()
    {
        return self::STATUS;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products')->withPivot('quantity', 'price');
    }

    /**
     * Сумма заказа
     *
     * @return mixed
     */
    public function getSumOrder()
    {
        return $this->products->sum(function ($item) {
            return $item->pivot->quantity * $item->pivot->price;
        });
    }

    /**
     * Локализованный статус
     *
     * @return array|string|null
     */
    public function getStatus()
    {
        return __('statuses.' . $this->getStatusLabel());
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return $this->getStatusLabel() === self::STATUS[0];
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->getStatusLabel() === self::STATUS[10];
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->getStatusLabel() === self::STATUS[20];
    }

    /**
     * @return mixed
     */
    private function getStatusLabel()
    {
        return self::STATUS[$this->status];
    }
}
