<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //
    protected $fillable = ['id', 'date', 'amount', 'product_name'];
}
