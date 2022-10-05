<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'customer_id';

    protected $table = 'customers';

    protected $fillable = [
        'customer_id', 'customer_name', 'email', 'tel_num', 'is_active', 'address',
    ];
}
