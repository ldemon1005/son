<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use App\Repositories\ConfigRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ConfigController extends Controller
{
    protected $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
        View::share('type_menu', 'config');
    }

    public function updateConfigView(){
        $config = $this->configRepository->getConfig();

        if(!$config){
            return $this->resFail(null, 'Không tìm thấy file cấu hình');
        }
        $config->banner_index = json_decode($config->banner_index);
        $config->banner_post = json_decode($config->banner_post);
        return view('admin.config.form', compact('config'));
    }

    public function updateConfig(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required',
            'address_factory' => 'required',
            'address_head' => 'required',
            'address_representative' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'facebook' => 'required',
            'banner_index' => 'required',
            'banner_post' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $config_data = $request->only('id', 'title','address_factory','address_head',
            'address_representative', 'phone', 'email','facebook','banner_index','banner_post',
            'content_home','seo_title','seo_description','seo_keyword', 'banner_introduce',
            'link_map','hotline','content_introduction','logo','zalo');

        $config_id = $request->get('id');

        unset($config_data['id']);
//        dd($config_data);
        $config_data['banner_index'] = json_encode(array_filter($config_data['banner_index']));
        $config_data['banner_post'] = json_encode(array_filter($config_data['banner_post']));
        try{
            $config = $this->configRepository->updateConfig($config_id, $config_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Update không thành công!');
        }
        if(!$config){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        return redirect()->back()->with(BaseModel::ALERT_SUCCESS, 'Update thành công!');
    }
}
