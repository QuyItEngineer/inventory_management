<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
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
     * @var OrderProductRepository
     */
    private $orderProductRepository;

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepo
     * @param OrderService $orderService
     * @param OrderProductRepository $orderProductRepository
     */
    public function __construct(OrderRepository $orderRepo, OrderService $orderService, OrderProductRepository $orderProductRepository)
    {
        $this->orderRepository = $orderRepo;
        $this->orderService = $orderService;
        $this->orderProductRepository = $orderProductRepository;
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
        if ($order == false) {
            Flash::error('Order saved fail.');
            throw new Exception('Order saved fail');
        }
        Flash::success('Order saved successfully.');
        return redirect('orders/' . $order->id);
    }

    public function showUpdateDetail($id)
    {
        return $this->orderService->generateThePdfFromOrder($id);
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
        $orderDetails = OrderProduct::query()
            ->select([
                'products.unique_code',
                'products.name',
                'order_products.quantity',
                'order_products.sum_price',
            ])
            ->join('products','order_products.product_id','=','products.id')
            ->where('order_id',$order->id)->get();

        return view('orders.show')
            ->with('order', $order)
            ->with('products', $orderDetails);
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

        $clients = Client::all()->where('id', $order->client_id)->pluck('name','id');
        $products = Product::all(['unique_code','name','quantity'])->sortBy('name');
        $orderDetails = OrderProduct::query()
            ->select([
                'products.unique_code',
                'products.name',
                'order_products.quantity',
            ])
            ->join('products','order_products.product_id','=','products.id')
            ->where('order_id',$order->id)->distinct()->get();

        return view('orders.edit')
            ->with('client_type', [
                Client::CLIENT_TYPE_NORMAL_TEXT,
                Client::CLIENT_TYPE_WHOLESALE_TEXT,
                Client::CLIENT_TYPE_RETAIL_TEXT,
            ])
            ->with('clients', $clients)
            ->with('products', $products)
            ->with('orderDetails', $orderDetails)
            ->with('order', $order);
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

        $params = array_merge($request->all(),[
            'client_type' => $order->client_type
        ]);

        try {
            $order = $this->orderService->updateDetail($id, $params);
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
        OrderProduct::query()->where('order_id',$id)->delete();

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }
}
