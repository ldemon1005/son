<?php

namespace App\Repositories;

use App\Models\Contact;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class ContactRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Contact';
    }

    public function getList($params = [], $limit = 20)
    {
        $limit = !empty($params['limit']) && intval($params['limit']) != $limit ? intval($params['limit']) : $limit;
        return Contact::where(function ($query) use ($params) {
                if (!empty($params['keyword'])) {
                    $query->where('name','like','%' . $params['keyword'] . '%');
                    $query->orwhere('email','like','%' . $params['keyword'] . '%');
                    $query->orwhere('phone','like','%' . $params['keyword'] . '%');
                }

                if (!empty($params['status']) || isset($params['status'])) {
                    $query->where('status', '=', intval($params['status']));
                }
            })->orderBy($params['order_by'] ?? 'created_at', $params['order_direction'] ?? 'desc')->paginate($limit);
    }

    public function getByID($contact_id)
    {
        return Contact::where('id', '=', $contact_id)->first();
    }

    public function findByContact($contact_name)
    {
        return Contact::where('name', '=', $contact_name)->first();
    }

    /**
     * @param $params
     * @return Contact
     * @throws Exception
     */
    public function createContact($params)
    {
        try {
            DB::beginTransaction();
            $params['created_at'] = time();
            $params['updated_at'] = time();
            $contact = $this->create($params);
            DB::commit();
            return $contact;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error: Insert DB');
        }
    }

    /**
     * @param $id
     * @param array $params
     * @return Contact
     * @throws Exception
     */
    public function updateContact($id, $params = [])
    {
        try {
            $params['updated_at'] = time();
            $updated_contact = $this->update($params, $id);
            return $updated_contact;
        } catch (ValidatorException $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function deleteContact($id)
    {
        $res = $this->delete($id);
        return $res;
    }
}
