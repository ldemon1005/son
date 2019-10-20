<?php

namespace App\Repositories;

use App\Models\Service;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class ServiceRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Service';
    }

    public function getList($params = [], $limit = 20)
    {
        $limit = !empty($params['limit']) && intval($params['limit']) != $limit ? intval($params['limit']) : $limit;
        return Service::where(function ($query) use ($params) {
                if (!empty($params['keyword'])) {
                    $query->where('title','like','%' . $params['keyword'] . '%');
                }

                if (!empty($params['status']) || isset($params['status'])) {
                    $query->where('status', '=', intval($params['status']));
                }
            })->orderBy($params['order_by'] ?? 'created_at', $params['order_direction'] ?? 'desc')->paginate($limit);
    }

    public function getByID($service_id)
    {
        return Service::where('id', '=', $service_id)->first();
    }

    public function findByService($service_name)
    {
        return Service::where('name', '=', $service_name)->first();
    }

    /**
     * @param $params
     * @return Service
     * @throws Exception
     */
    public function createService($params)
    {
        try {
            DB::beginTransaction();
            $params['created_at'] = time();
            $params['updated_at'] = time();
            $params['slug'] = str_slug($params['title']);
            $service = $this->create($params);
            DB::commit();
            return $service;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error: Insert DB');
        }
    }

    /**
     * @param $id
     * @param array $params
     * @return Service
     * @throws Exception
     */
    public function updateService($id, $params = [])
    {
        try {
            $params['updated_at'] = time();
            if(isset($params['slug'])) $params['slug'] = str_slug($params['title']);
            $updated_service = $this->update($params, $id);
            return $updated_service;
        } catch (ValidatorException $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function deleteService($id)
    {
        $res = $this->delete($id);
        return $res;
    }
}
