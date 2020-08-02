<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use Flash;
use Response;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepo
     * @param OrderService $orderService
     */
    public function __construct(OrderRepository $orderRepo, OrderService $orderService)
    {
        $this->orderRepository = $orderRepo;
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->all()->sortByDesc("updated_at");

        return view('orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        $products = Product::all(['unique_code','name','quantity'])->sortBy('name');
        $clients = Client::all()->sortBy("name")->pluck('name','id');

        return view('orders.create')
            ->with('products', $products)
            ->with('client_type', [
                Client::CLIENT_TYPE_NORMAL_TEXT,
                Client::CLIENT_TYPE_WHOLESALE_TEXT,
                Client::CLIENT_TYPE_RETAIL_TEXT,
            ])
            ->with('clients', $clients);
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     * @throws Exception
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderService->create($input);
        Flash::success('Order saved successfully.');
        return redirect('orders-preview/' . $order->id);
    }

    public function showUpdateDetail($id)
    {
        $order = $this->orderRepository->find($id);
        return view('orders.show-preview')->with('order', $order);
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        try {
            $order = $this->orderService->updateDetail($id, $request->all());
        } catch (Exception $e) {
            Flash::error($e->getMessage());
        }

        Flash::success('Order updated successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }
}
