<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Client
 * @package App\Models
 * @version March 19, 2020, 3:56 pm UTC
 *
 * @property string name
 * @property integer phone_number_1
 * @property integer phone_number_2
 * @property string address
 * @property string car_group_type
 * @property string shipping_type
 */
class Client extends Model
{
    public $table = 'clients';

    const CLIENT_TYPE_NORMAL = 0;
    const CLIENT_TYPE_WHOLESALE = 1;
    const CLIENT_TYPE_RETAIL = 2;

    const CLIENT_TYPE_NORMAL_TEXT = "Giá mặc định";
    const CLIENT_TYPE_WHOLESALE_TEXT = "Bán sỉ";
    const CLIENT_TYPE_RETAIL_TEXT = "Bán lẻ";

    public $fillable = [
        'name',
        'phone_number_1',
        'phone_number_2',
        'address',
        'car_group_type',
        'shipping_type',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'phone_number_1' => 'integer',
        'phone_number_2' => 'integer',
        'address' => 'string',
        'car_group_type' => 'string',
        'shipping_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:clients,name',
        'phone_number_1' => 'required'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
