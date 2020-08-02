<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version March 19, 2020, 3:57 pm UTC
*/

class OrderProductRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderProduct::class;
    }

    /**
     * Get searchable fields array
     *
     * @return void
     */
    public function getFieldsSearchable()
    {
        // TODO: Implement getFieldsSearchable() method.
    }
}
