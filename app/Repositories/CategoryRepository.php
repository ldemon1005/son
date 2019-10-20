<?php

namespace App\Repositories;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class CategoryRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Category';
    }

    public function getList($params = [], $limit = 20)
    {
        $limit = !empty($params['limit']) && intval($params['limit']) != $limit ? intval($params['limit']) : $limit;
        return Category::where(function ($query) use ($params) {
                if (!empty($params['keyword'])) {
                    $query->where('title','like','%' . $params['keyword'] . '%');
                }

                if (!empty($params['status']) || isset($params['status'])) {
                    $query->where('status', '=', intval($params['status']));
                }
            })->orderBy($params['order_by'] ?? 'created_at', $params['order_direction'] ?? 'desc')->paginate($limit);
    }

    public function getByID($category_id)
    {
        return Category::where('id', '=', $category_id)->first();
    }

    public function findByCategory($category_name)
    {
        return Category::where('name', '=', $category_name)->first();
    }

    /**
     * @param $params
     * @return Category
     * @throws Exception
     */
    public function createCategory($params)
    {
        try {
            DB::beginTransaction();
            $params['created_at'] = time();
            $params['updated_at'] = time();
            $category = $this->create($params);
            DB::commit();
            return $category;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error: Insert DB');
        }
    }

    /**
     * @param $id
     * @param array $params
     * @return Category
     * @throws Exception
     */
    public function updateCategory($id, $params = [])
    {
        try {
            $params['updated_at'] = time();
            $updated_category = $this->update($params, $id);
            return $updated_category;
        } catch (ValidatorException $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function deleteCategory($id)
    {
        $res = $this->delete($id);
        return $res;
    }
}
