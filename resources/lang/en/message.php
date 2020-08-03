<?php

use App\Models\Client;

return [

    /*
    |--------------------------------------------------------------------------
    | Message trans
    |--------------------------------------------------------------------------
    */

    'client_type' => [
        0 => Client::CLIENT_TYPE_NORMAL_TEXT,
        1 => Client::CLIENT_TYPE_WHOLESALE_TEXT,
        2 => Client::CLIENT_TYPE_RETAIL_TEXT,
    ]

];
