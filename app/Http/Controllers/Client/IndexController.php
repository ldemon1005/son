<?php

namespace App\Http\Controllers\Client;

use App\Models\BaseModel;
use App\Repositories\CategoryRepository;
use App\Repositories\ConfigRepository;
use App\Repositories\ContactRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    private $configRepository;
    private $contactRepository;
    private $serviceRepository;
    private $productRepository;
    private $categoryRepository;
    public function __construct(ConfigRepository $configRepository,ServiceRepository $serviceRepository, ProductRepository $productRepository,
                                CategoryRepository $categoryRepository,
                                ContactRepository $contactRepository)
    {
        $this->configRepository = $configRepository;
        $this->contactRepository = $contactRepository;
        $this->serviceRepository = $serviceRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;

        $config = $this->configRepository->first();
        $config->banner_index = json_decode($config->banner_index);
        $config->banner_post = json_decode($config->banner_post);
        $services = $this->serviceRepository->getList(['status' => BaseModel::STATUS_ACTIVE], 3);
        $list_category = $this->categoryRepository->getList(['status' => BaseModel::STATUS_ACTIVE]);

        View::share([
            'config' => $config,
            'services' => $services,
            'list_category' => $list_category
        ]);
    }

    public function index(){
        return view('client.index.index');
    }

    public function detailService($slug = null){
        $params = explode('---',$slug);
        if(isset($params[1])){

            $service = $this->serviceRepository->getByID($params[1]);

            if(!$service){
                return redirect()->back()->withErrors('Vui lòng quay lại sau!');
            }

            $service_data = [
                'total_view' => $service->total_view + 1
            ];
            $this->serviceRepository->updateService($service->id,$service_data);

            return view('client.detail.service',compact('service'));
        }
        return redirect()->back()->withErrors('Vui lòng quay lại sau!');
    }

    public function detailCategory($slug = null){
        $params = explode('---',$slug);
        if(isset($params[1])){

            $category = $this->categoryRepository->getByID($params[1]);

            if(!$category){
                return redirect()->back()->withErrors('Vui lòng quay lại sau!');
            }

            $category_data = [
                'total_view' => $category->total_view + 1
            ];
            $this->categoryRepository->updateCategory($category->id,$category_data);
            $category->slide_image = json_decode($category->slide_image);
            return view('client.detail.category',compact('category'));
        }
        return redirect()->back()->withErrors('Vui lòng quay lại sau!');
    }

    public function detailProduct($slug = null){
        $params = explode('---',$slug);
        if(isset($params[1])){

            $product = $this->productRepository->getByID($params[1]);

            if(!$product){
                return redirect()->back()->withErrors('Vui lòng quay lại sau!');
            }

            $product_data = [
                'total_view' => $product->total_view + 1
            ];
            $this->productRepository->updateProduct($product->id,$product_data);
            $category = $this->categoryRepository->getByID($product->category_id);
            return view('client.detail.product',compact('product','category'));
        }
        return redirect()->back()->withErrors('Vui lòng quay lại sau!');
    }

    public function introduction(){
        return view('client.index.introduction');
    }

    public function contactForm(){
        return view('client.index.contact');
    }

    public function contactAction(Request $request){
        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'phone' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors('Gửi liên hệ không thành công!.Vui lòng xem lại dữ liệu nhập vào.');
        }

        $contact_data = $request->only('name','phone','content','title');

        $contact_data['status'] = BaseModel::STATUS_INACTIVE;

        try{
            $contact = $this->contactRepository->createContact($contact_data);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Gửi liên hệ không thành công!');
        }

        if(!$contact){
            return redirect()->back()->withErrors('Gửi liên hệ không thành công!');
        }

        return redirect()->back()->with(BaseModel::ALERT_SUCCESS, 'Gửi liên hệ thành công!');
    }

    public function search(Request $request){
        $search_data = $request->only('search_type','keyword');
        if($search_data['search_type'] == 1){
            return view('client.post.index');
        }else{
            return view('client.index.search_service');
        }
    }
}
