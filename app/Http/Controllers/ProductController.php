<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

/**
 * Class ProductController
 *
 * @package App\Http\Controllers
 *
 * @author Aleksandr Gavva
 */
class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductController constructor
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Список продуктов
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productService->getProducts();
        return view('products.index', compact([
            'products',
            ])
        );
    }

    /**
     * Сохранение продукта
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'price' => 'required|numeric',
        ]);

        $product = $this->productService->getProduct($id);
        if (!$this->productService->saveProduct($product, $request)) {
            return back()->withErrors('Ошибка сохранения продукта');
        }

        return back()->with('success', true);
    }
}
