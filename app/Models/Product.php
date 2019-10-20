<?php

namespace App\Models;

class Product extends BaseModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'product';
}
