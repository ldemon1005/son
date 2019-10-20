<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        View::share('type_menu', 'product');
    }

    public function listView(Request $request){
        $params = [
            'keyword' => '',
        ];
        $query = $request->only('keyword', 'status','category');
        $params = array_merge($params, $query);
        if(isset($params['status']) && $params['status'] == 9){
            unset($params['status']);
        }
        $list_product = $this->productRepository->getList($params);
        return view('admin.product.list_view', compact('list_product','params'));
    }

    public function updateProductView($id = null){
        $product = null;
        if($id != 0){
            $product = $this->productRepository->getByID($id);

            if(!$product){
                $this->resFail(null, 'Không tìm thấy sản phẩm');
            }
        }

        return view('admin.product.form', compact('product'));
    }

    public function createProduct(Request $request){
        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'code' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->resFail(null, $validator->errors());
        }

        $product_data = $request->only('id','title','status', 'content','description', 'seo_title','seo_description','seo_keyword','image','code');

        if(isset($product_data['status']) && $product_data['status'] == 'on'){
            $product_data['status'] = 1;
        }else{
            $product_data['status'] = 0;
        }

        try{
            $product = $this->productRepository->createProduct($product_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Tạo mới không thành công!');
        }

        if(!$product){
            return redirect()->back()->withErrors('Tạo mới không thành công!');
        }

        return redirect()->route('admin_list_product')->with(BaseModel::ALERT_SUCCESS, 'Tạo mới thành công!');
    }

    public function updateProduct(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required',
            'title' => 'required',
            'code' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            redirect()->back()->withErrors($validator->errors());
        }

        $product_data = $request->only('id','title','status', 'content','description', 'seo_title','seo_description','seo_keyword','image','code');

        $product_id = $request->get('id');

        unset($product_data['id']);

        if(isset($product_data['status']) && $product_data['status'] == 'on'){
            $product_data['status'] = 1;
        }else{
            $product_data['status'] = 0;
        }

        try{
            $product = $this->productRepository->updateProduct($product_id, $product_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        if(!$product){
            return redirect()->back()->withErrors('Update không thành công!');
        }

        return redirect()->route('admin_list_product')->with(BaseModel::ALERT_SUCCESS, 'Update thành công!');
    }

    public function deleteProduct(Request $request){
        $validator = Validator::make($request->input(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->resFail(null, $validator->errors());
        }
        $product_data = $request->only('id');

        try {
            $product_deleted = $this->productRepository->deleteProduct($product_data['id']);
        } catch (\Exception $e) {
            return $this->resFail(null, $e->getMessage());
        }

        if (!$product_deleted) {
            return $this->resFail(null, 'Xoá không thành công. Vui lòng thử lại!');
        }

        return $this->resSuccess($product_deleted, 'Xoá thành công!');

    }
}
