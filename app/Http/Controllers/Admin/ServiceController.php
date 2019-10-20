<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
        View::share('type_menu', 'service');
    }

    public function listView(Request $request){
        $params = [
            'keyword' => '',
        ];
        $query = $request->only('keyword', 'status');
        $params = array_merge($params, $query);
        if(isset($params['status']) && $params['status'] == 9){
            unset($params['status']);
        }
        $list_service = $this->serviceRepository->getList($params);
        return view('admin.service.list_view', compact('list_service','params'));
    }

    public function updateServiceView($id = null){
        $service = null;
        if($id != 0){
            $service = $this->serviceRepository->getByID($id);

            if(!$service){
                $this->resFail(null, 'Không tìm thấy sản phẩm');
            }
        }

        return view('admin.service.form', compact('service'));
    }

    public function createService(Request $request){
        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->resFail(null, $validator->errors());
        }

        $service_data = $request->only('id','title','status', 'content','description', 'seo_title','seo_description','seo_keyword','image','icon','sub_title');

        if(isset($service_data['status']) && $service_data['status'] == 'on'){
            $service_data['status'] = 1;
        }else{
            $service_data['status'] = 0;
        }

        try{
            $service = $this->serviceRepository->createService($service_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Tạo mới không thành công!');
        }

        if(!$service){
            return redirect()->back()->withErrors('Tạo mới không thành công!');
        }

        return redirect()->route('admin_list_service')->with(BaseModel::ALERT_SUCCESS, 'Tạo mới thành công!');
    }

    public function updateService(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            redirect()->back()->withErrors($validator->errors());
        }

        $service_data = $request->only('id','title','status', 'content','description', 'seo_title','seo_description','seo_keyword','image','icon','sub_title');

        $service_id = $request->get('id');

        unset($service_data['id']);

        if(isset($service_data['status']) && $service_data['status'] == 'on'){
            $service_data['status'] = 1;
        }else{
            $service_data['status'] = 0;
        }

        try{
            $service = $this->serviceRepository->updateService($service_id, $service_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        if(!$service){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        return redirect()->route('admin_list_service')->with(BaseModel::ALERT_SUCCESS, 'Update thành công!');
    }

    public function deleteService(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->resFail(null, $validator->errors());
        }
        $service_data = $request->only('id');

        try {
            $service_deleted = $this->serviceRepository->deleteService($service_data['id']);
        } catch (\Exception $e) {
            return $this->resFail(null, $e->getMessage());
        }

        if (!$service_deleted) {
            return $this->resFail(null, 'Xoá không thành công. Vui lòng thử lại!');
        }

        return $this->resSuccess($service_deleted, 'Xoá thành công!');

    }
}
