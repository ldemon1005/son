<?php

namespace App\Models;

class Product extends BaseModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'product';

    public function getCategory()
    {
        return $this->hasOne('App\Models\Category',  'id', 'category_id');
    }
}
