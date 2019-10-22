<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        View::share('type_menu', 'product');
    }

    public function listView(Request $request){
        $params = [
            'keyword' => '',
        ];
        $query = $request->only('keyword', 'status','category_id');
        $params = array_merge($params, $query);
        if(isset($params['status']) && $params['status'] == 9){
            unset($params['status']);
        }
        $list_category = $this->categoryRepository->getList($params);
        return view('admin.category.list_view', compact('list_category','params'));
    }

    public function updateCategoryView($id = null){
        $category = null;
        if($id != 0){
            $category = $this->categoryRepository->getByID($id);

            if(!$category){
                $this->resFail(null, 'Không tìm thấy sản phẩm');
            }
        }
        $category->slide_image = json_decode($category->slide_image);
        return view('admin.category.form', compact('category'));
    }

    public function createCategory(Request $request){
        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->resFail(null, $validator->errors());
        }

        $category_data = $request->only('id','title','status', 'content','description1','description2', 'seo_title','seo_description','seo_keyword','image','slide_image','title_mobile');

        $category_data['slide_image'] = json_encode(array_filter($category_data['slide_image']));

        if(isset($category_data['status']) && $category_data['status'] == 'on'){
            $category_data['status'] = 1;
        }else{
            $category_data['status'] = 0;
        }

        try{
            $category = $this->categoryRepository->createCategory($category_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Tạo mới không thành công!');
        }

        if(!$category){
            return redirect()->back()->withErrors('Tạo mới không thành công!');
        }

        return redirect()->route('admin_list_category')->with(BaseModel::ALERT_SUCCESS, 'Tạo mới thành công!');
    }

    public function updateCategory(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            redirect()->back()->withErrors($validator->errors());
        }

        $category_data = $request->only('id','title','status', 'content','description1','description2', 'seo_title','seo_description','seo_keyword','image','slide_image','title_mobile');

        $category_data['slide_image'] = json_encode(array_filter($category_data['slide_image']));

        $category_id = $request->get('id');

        unset($category_data['id']);

        if(isset($category_data['status']) && $category_data['status'] == 'on'){
            $category_data['status'] = 1;
        }else{
            $category_data['status'] = 0;
        }

        try{
            $category = $this->categoryRepository->updateCategory($category_id, $category_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        if(!$category){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        return redirect()->route('admin_list_category')->with(BaseModel::ALERT_SUCCESS, 'Update thành công!');
    }

    public function deleteCategory(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->resFail(null, $validator->errors());
        }
        $category_data = $request->only('id');

        try {
            $category_deleted = $this->categoryRepository->deleteCategory($category_data['id']);
        } catch (\Exception $e) {
            return $this->resFail(null, $e->getMessage());
        }

        if (!$category_deleted) {
            return $this->resFail(null, 'Xoá không thành công. Vui lòng thử lại!');
        }

        return $this->resSuccess($category_deleted, 'Xoá thành công!');

    }
}
