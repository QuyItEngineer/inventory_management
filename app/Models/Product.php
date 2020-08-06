<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Product
 * @package App\Models
 * @version March 19, 2020, 3:49 pm UTC
 *
 * @property string unique_code
 * @property string name
 * @property integer quantity
 * @property number price
 * @property number wholesale_price
 * @property number retail_price
 */
class Product extends Model
{

    public $table = 'products';

    public $fillable = [
        'unique_code',
        'name',
        'quantity',
        'input_price',
        'price',
        'wholesale_price',
        'retail_price',
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
        'name' => 'string',
        'quantity' => 'integer',
        'input_price' => 'float',
        'price' => 'float',
        'wholesale_price' => 'float',
        'retail_price' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'unique:products,name'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order','order_products');
    }
}
