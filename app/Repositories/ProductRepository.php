<?php

namespace App\Repositories;

use App\Models\Product;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class ProductRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Product';
    }

    public function getList($params = [], $limit = 20)
    {
        $limit = !empty($params['limit']) && intval($params['limit']) != $limit ? intval($params['limit']) : $limit;
        return Product::where(function ($query) use ($params) {
                if (!empty($params['keyword'])) {
                    $query->where('title','like','%' . $params['keyword'] . '%');
                }

                if (!empty($params['status']) || isset($params['status'])) {
                    $query->where('status', '=', intval($params['status']));
                }
            })->orderBy($params['order_by'] ?? 'created_at', $params['order_direction'] ?? 'desc')->paginate($limit);
    }

    public function getByID($product_id)
    {
        return Product::where('id', '=', $product_id)->first();
    }

    public function findByProduct($product_name)
    {
        return Product::where('name', '=', $product_name)->first();
    }

    /**
     * @param $params
     * @return Product
     * @throws Exception
     */
    public function createProduct($params)
    {
        try {
            DB::beginTransaction();
            $params['created_at'] = time();
            $params['updated_at'] = time();
            $params['slug'] = str_slug($params['title']);
            $product = $this->create($params);
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error: Insert DB');
        }
    }

    /**
     * @param $id
     * @param array $params
     * @return Product
     * @throws Exception
     */
    public function updateProduct($id, $params = [])
    {
        try {
            $params['updated_at'] = time();
            if(isset($params['slug'])) $params['slug'] = str_slug($params['title']);
            $updated_product = $this->update($params, $id);
            return $updated_product;
        } catch (ValidatorException $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function deleteProduct($id)
    {
        $res = $this->delete($id);
        return $res;
    }
}
