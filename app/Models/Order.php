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
        'order_code',
        'unique_code',
        'quantity',
        'wholesale_price',
        'retail_price',
        'real_cost',
        'debt_in_scope'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_code' => 'string', //en_code
        'unique_code' => 'string',
        'quantity' => 'integer',
        'wholesale_price' => 'float',
        'retail_price' => 'float',
        'real_cost' => 'float',
        'debt_in_scope' => 'float'
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
        return $this->belongsToMany('App\Models\Product');
    }

    public function client()
    {
        $this->belongsTo(Client::class);
    }

}
