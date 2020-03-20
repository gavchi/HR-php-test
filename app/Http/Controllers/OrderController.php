<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\OrderService;
use App\Services\PartnerService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class OrderController
 *
 * @package App\Http\Controllers
 *
 * @author Aleksandr Gavva
 */
class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;
    /**
     * @var PartnerService
     */
    private $partnerService;

    /**
     * TestController constructor
     */
    public function __construct(
        OrderService $orderService,
        PartnerService $partnerService
    ) {
        $this->orderService = $orderService;
        $this->partnerService = $partnerService;
    }

    /**
     * Список заказов
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $expiredOrders = $this->orderService->getExpiredOrdes();
        $currentOrders = $this->orderService->getCurrentOrders();
        $newOrders = $this->orderService->getNewOrders();
        $completedOrders = $this->orderService->getCompletedOrders();
        return view('orders.index', compact([
            'expiredOrders',
            'currentOrders',
            'newOrders',
            'completedOrders',
            ])
        );
    }

    /**
     * Страница редкатирования заказа
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $order = $this->orderService->getOrder($id);
        $partners = $this->partnerService->getPartners();
        return view('orders.edit', compact([
            'order',
            'partners',
            ])
        );
    }

    /**
     * Сохранение заказа
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'client_email' => 'required|email',
            'partner_id' => 'required|exists:partners,id',
            'status' => [
                'required',
                Rule::in(array_keys(Order::getAvailableStatuses())),
            ],
        ]);

        $order = $this->orderService->getOrder($id);
        if (!$this->orderService->saveOrder($order, $request)) {
            return back()->withErrors('Ошибка сохранения заказа');
        }
        $this->orderService->sendEmails($order);

        return back()->with('success', true);
    }
}
