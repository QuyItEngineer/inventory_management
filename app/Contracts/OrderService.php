<?php

namespace App\Contracts;

interface OrderService
{

    /**
     * @param $params
     * @return mixed
     */
    public function create($params);

    /**
     * @param $id
     * @param $params
     * @return mixed
     */
    public function updateDetail($id, $params);
}
