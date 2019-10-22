<?php

namespace App\Models;

class Category extends BaseModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'category';

    public function listProduct($id){
        return Product::where('status',BaseModel::STATUS_ACTIVE)->where('category_id',$id)->get(['id', 'title', 'slug', 'code']);
    }
}
