<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;
use App\User;
use Prettus\Validator\Exceptions\ValidatorException;

class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\User';
    }

    public function getList($params = [], $limit = 20)
    {
        $limit = !empty($params['limit']) && intval($params['limit']) != $limit ? intval($params['limit']) : $limit;
        return User::where(function ($query) use ($params) {
                if (!empty($params['keyword'])) {
                    $query->whereLike(['email', 'user_name'], $params['keyword']);
                }

                if (!empty($params['status']) || isset($params['status'])) {
                    $query->where('status', '=', intval($params['status']));
                }
            })->orderBy($params['order_by'] ?? 'created_at', $params['order_direction'] ?? 'desc')->paginate($limit);
    }

    public function getByID($user_id)
    {
        return User::where('id', '=', $user_id)->first();
    }

    public function findByEmail($email)
    {
        return User::where('email', '=', $email)->first();
    }

    public function findByUsername($user_name)
    {
        return User::where('user_name', '=', $user_name)->first();
    }

    /**
     * @param $params
     * @return User
     * @throws Exception
     */
    public function createUser($params)
    {
        try {
            $params['password'] = app('hash')->make($params['password']);
            DB::beginTransaction();
            $user = $this->create($params);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error: Insert DB');
        }
    }

    /**
     * @param $id
     * @param array $params
     * @return User
     * @throws Exception
     */
    public function updateUser($id, $params = [])
    {
        try {
            $updated_user = $this->update($params, $id);
            return $updated_user;
        } catch (ValidatorException $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function deleteUser($id)
    {
        $res = $this->delete($id);
        return $res;
    }
}
