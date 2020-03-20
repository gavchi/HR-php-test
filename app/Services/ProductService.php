<?php

namespace App\Services;

use App\Product;
use Illuminate\Http\Request;

/**
 * Class ProductService
 *
 * @package App\Services
 *
 * @author Aleksandr Gavva
 */
class ProductService
{
    /**
     * Список продуктов
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getProducts()
    {
        $products = Product::with(['vendor'])
            ->orderBy('name')
            ->paginate(25);
        return $products;
    }

    /**
     * Получить продукт
     *
     * @param $id
     * @return Product
     */
    public function getProduct($id)
    {
        return Product::with('vendor')->findOrFail($id);
    }

    /**
     * Сохранение продукта пользователем
     *
     * @param Product $order
     * @param Request $request
     * @return bool
     */
    public function saveProduct(Product $order, Request $request)
    {
        return $order->update($request->except('_token'));
    }
}
