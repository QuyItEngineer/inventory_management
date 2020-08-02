<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductApiController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * ProductApiController constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function checkProduct()
    {
        $params = request()->all();
        $data = Product::query()->select('quantity')
            ->where('unique_code', $params['unique_code'])
            ->first();

        if($data->quantity >= $params['quantity']) {
            return [
                'data' => true,
                'unique_code' => $params['unique_code']
            ];
        }

        return [
            'data' => false,
            'unique_code' => $params['unique_code']
        ];
    }
}
