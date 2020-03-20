<?php

namespace App\Services;

use App\Mail\OrderCompleted;
use App\Order;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class OrderService
 *
 * @package App\Services
 *
 * @author Aleksandr Gavva
 */
class OrderService
{
    /**
     * Список заказов
     *
     * @return Order[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getOrders()
    {
        $orders = Order::with(['partner', 'products'])->get();
        return $orders;
    }

    /**
     * Получить заказ
     *
     * @param $id
     * @return Order
     */
    public function getOrder($id)
    {
        return Order::with(['products.vendor'])->findOrFail($id);
    }

    /**
     * Просроченные заказы
     *
     * @return Order[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getExpiredOrdes()
    {
        return Order::with(['partner', 'products'])
            ->where([
                ['delivery_dt', '<=', Carbon::now()],
                ['status', '=', 10],
            ])
            ->latest('delivery_dt')
            ->take(50)
            ->get();
    }

    /**
     * Текущие заказы
     *
     * @return Order[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getCurrentOrders()
    {
        return Order::with(['partner', 'products'])
            ->where([
                ['delivery_dt', '>=', Carbon::now()->subHours(24)],
                ['delivery_dt', '<=', Carbon::now()],
                ['status', '=', 10],
            ])
            ->oldest('delivery_dt')
            ->get();
    }

    /**
     * Новые заказы
     *
     * @return Order[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getNewOrders()
    {
        return Order::with(['partner', 'products'])
            ->where([
                ['delivery_dt', '>=', Carbon::now()->startOfDay()],
                ['status', '=', 0],
            ])
            ->oldest('delivery_dt')
            ->take(50)
            ->get();
    }

    /**
     * Выполненные заказы
     *
     * @return Order[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getCompletedOrders()
    {
        return Order::with(['partner', 'products'])
            ->where([
                ['delivery_dt', '>=', Carbon::now()->startOfDay()],
                ['delivery_dt', '<=', Carbon::now()->endOfDay()],
                ['status', '=', 20],
            ])
            ->latest('delivery_dt')
            ->take(50)
            ->get();
    }

    /**
     * Сохранение заказа пользователем
     *
     * @param Order $order
     * @param Request $request
     * @return bool
     */
    public function saveOrder(Order $order, Request $request)
    {
        return $order->update($request->except('_token'));
    }

    /**
     * Отправка email по заказу
     *
     * @param Order $order
     */
    public function sendEmails(Order $order)
    {
        if ($order->wasChanged('status') && $order->isCompleted()) {
            Mail::to($order->partner->email)
                ->bcc(
                    $order->products->map(function(Product $product){
                        return $product->vendor->email;
                    })
                )
                //Лучше в очередь, демо
                ->send(new OrderCompleted($order));
        }
    }
}
