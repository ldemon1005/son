<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
        View::share('type_menu', 'contact');
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
        $list_contact = $this->contactRepository->getList($params);
        return view('admin.contact.list_view', compact('list_contact','params'));
    }

    public function updateContactView($id){
        $contact = $this->contactRepository->getByID($id);

        if(!$contact){
            $this->resFail(null, 'Không tìm thấy thiết bị');
        }

        $content = view('admin.contact.form', compact('contact'))->render();

        return $this->resSuccess($content, '');
    }

    public function updateContact(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            redirect()->back()->withErrors($validator->errors());
        }

        $contact_data = $request->only('id','status');

        $contact_id = $request->get('id');

        unset($contact_data['id']);

        if(isset($contact_data['status']) && $contact_data['status'] == 'on'){
            $contact_data['status'] = 1;
        }else{
            $contact_data['status'] = 0;
        }

        try{
            $contact = $this->contactRepository->updateContact($contact_id, $contact_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        if(!$contact){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        return redirect()->route('admin_list_contact')->with(BaseModel::ALERT_SUCCESS, 'Update thành công!');
    }

    public function deleteContact(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->resFail(null, $validator->errors());
        }
        $contact_data = $request->only('id');

        try {
            $contact_deleted = $this->contactRepository->deleteContact($contact_data['id']);
        } catch (\Exception $e) {
            return $this->resFail(null, $e->getMessage());
        }

        if (!$contact_deleted) {
            return $this->resFail(null, 'Xoá không thành công. Vui lòng thử lại!');
        }

        return $this->resSuccess($contact_deleted, 'Xoá thành công!');

    }
}
