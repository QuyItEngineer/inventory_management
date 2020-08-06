<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Product;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Exception;

class OrderService implements \App\Contracts\OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderProductRepository
     */
    private $orderProductRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * OrderService constructor.
     * @param OrderRepository $orderRepository
     * @param OrderProductRepository $orderProductRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        OrderRepository $orderRepository,
        OrderProductRepository $orderProductRepository,
        ProductRepository $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param $params
     * @return mixed
     * @throws Exception
     */
    public function create($params)
    {
        DB::beginTransaction();
        try {
            $orderAttribute = $this->prepareOrderCreateParams($params);
            $order = $this->orderRepository->create($orderAttribute);
            $this->saveOrderProducts($this->prepareOrderProductsCreateParams($params), $order->id);
            DB::commit();
            return $order;
        } catch (Exception $exception) {
            DB::rollBack();
            \Log::error($exception->getMessage());
            return false;
        }
    }

    /**
     * @param $id
     * @param $params
     * @return mixed
     * @throws Exception
     */
    public function updateDetail($id, $params)
    {
        DB::beginTransaction();
        try {
//            $orderAttribute = $this->prepareOrderCreateParams($params);
            $this->saveOrderProducts($this->prepareOrderProductsCreateParams($params) ?? [], $id);
            $order = $this->orderRepository->update([
                'total_price' => $this->getTotalPriceForUpdate($id)
            ], $id);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * @param $products
     * @param string $order_id
     */
    private function saveOrderProducts($products, $order_id = '')
    {
//        if (!empty($order_id)) {
//            $query = OrderProduct::query();
//            $query->where('order_id',$order_id)->delete();
//        }
        $data = [
            'order_id' => $order_id,
        ];
        foreach($products as $product) {
            $data['product_id'] = $product['product_id'];
            $data['quantity'] = $product['quantity'];
            $data['sum_price'] = $product['sum_price'];
            $this->orderProductRepository->create($data);
            $this->productRepository->update([
                'quantity' => $product['quantity_after_order']
            ], $product['product_id']);
        }
    }

    private function prepareOrderCreateParams($params)
    {
        return [
            'unique_code' => base64_encode(date('Y-m-d H:i:s')).'soc-store',
            'client_id' => $params['client_id'],
            'client_type' => $params['client_type'],
            'total_price' => (!empty($params['products'])) ? $this->getTotalPrice($params) : 0,
        ];
    }

    private function getTotalPrice($params)
    {
        $totalPrice = 0;
        $products = $this->prepareOrderProductsCreateParams($params);
        foreach ($products as $product) {
            $totalPrice += $product['sum_price'];
        }
        return $totalPrice;
    }

    private function getTotalPriceForUpdate($id)
    {
        $totalPrice = 0;
        $orderProducts = $this->orderProductRepository->where([
            'order_id' => $id
        ])->get();
        foreach ($orderProducts as $product) {
            $totalPrice += $product->sum_price;
        }
        return $totalPrice;
    }

    private function prepareOrderProductsCreateParams($params)
    {
        $orderProductsParams = [];
        foreach ($params['products'] as $key => $product) {
            if (empty($product['unique_code'])) continue;
            switch ($params['client_type']) {
                case Client::CLIENT_TYPE_NORMAL:
                    $orderProductsParams[$key] = $this->getPriceProductByClientType('price', $product['unique_code'], $product['quantity']);
                    break;
                case Client::CLIENT_TYPE_WHOLESALE:
                    $orderProductsParams[$key] = $this->getPriceProductByClientType('wholesale_price', $product['unique_code'], $product['quantity']);
                    break;
                case Client::CLIENT_TYPE_RETAIL:
                    $orderProductsParams[$key] = $this->getPriceProductByClientType('retail_price', $product['unique_code'], $product['quantity']);
                    break;
            }
        }
        return $orderProductsParams;
    }

    /**
     * @param $type : price, wholesale_price, retail_price
     * @param $unique_code
     * @param $quantity
     * @return array
     */
    private function getPriceProductByClientType($type, $unique_code, $quantity)
    {
        $query = Product::query();
        $product = $query->select(['id','quantity',$type])
            ->where('unique_code', $unique_code)
            ->first()->toArray();

        if ($product['quantity'] < $quantity) {
            return [];
        }

        return [
            'product_id' => $product['id'],
            'quantity' => $quantity,
            'quantity_after_order' => $product['quantity'] - $quantity,
            'sum_price' => $quantity * $product[$type],
        ];
    }

    /**
     * @return mixed
     */
    public function generateThePdfFromOrder($id)
    {
        $dateNow = date('Y/m/d H:i');
        $order = $this->orderRepository->find($id);
        if (empty($order)) {
            return false;
        }
        $orderProducts = $this->orderProductRepository->where([
            'order_id' => $order->id
        ])->get();

        $generatePdf = PDF::loadView('orders.show-preview',[
            'order' => $order,
            'orderDetails' => $orderProducts,
            'dateNow' => $dateNow,
            'user' => \Auth::user()->name ?? "",
            'totalQuantity' => $this->getSumQuantity($orderProducts),
        ])->setPaper('a4', 'landscape');;

        return $generatePdf->download();
    }

    private function getSumQuantity($orderProducts)
    {
        $sum = 0;
        foreach ($orderProducts as $product) {
            $sum += $product->quantity;
        }

        return $sum;
    }
}
