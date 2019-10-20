<?php

namespace App\Repositories;

use App\Models\Config;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class ConfigRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Config';
    }

    public function getByID($config_id)
    {
        return Config::where('id', '=', $config_id)->first();
    }

    public function getConfig()
    {
        return Config::first();
    }

    /**
     * @param $id
     * @param array $params
     * @return Config
     * @throws Exception
     */
    public function updateConfig($id, $params = [])
    {
        try {
            $params['updated_at'] = time();
            $updated_config = $this->update($params, $id);
            return $updated_config;
        } catch (ValidatorException $e) {
            throw new Exception($e->getMessage());
        }

    }
}
