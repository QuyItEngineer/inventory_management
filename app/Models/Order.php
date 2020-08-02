<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Order
 * @package App\Models
 * @version March 19, 2020, 3:57 pm UTC
 *
 * @property string unique_code
 * @property integer quantity
 * @property number wholesale_price
 * @property number retail_price
 * @property number real_cost
 * @property number debt_in_scope
 */
class Order extends Model
{
    public $table = 'orders';

    public $fillable = [
        'unique_code',
        'client_id',
        'client_type',
        'total_price',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'unique_code' => 'string',
        'client_id' => 'integer',
        'client_type' => 'integer',
        'total_price' => 'float',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product','order_products');
    }

    public function client()
    {
        $this->belongsTo(Client::class);
    }

}
