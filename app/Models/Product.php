<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'product_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $table = 'products';

    protected $fillable = [
        'product_id', 'product_name', 'product_image', 'product_price', 'is_sales', 'description',
    ];
}
