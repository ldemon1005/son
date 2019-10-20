<?php

namespace App\Http\Controllers\Client;

use App\Models\BaseModel;
use App\Models\Post;
use App\Repositories\CategoryServiceRepository;
use App\Repositories\ConfigRepository;
use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $configRepository;
    private $postRepository;
    private $categoryServiceRepository;
    public function __construct(ConfigRepository $configRepository, PostRepository $postRepository, CategoryServiceRepository $categoryServiceRepository)
    {
        $this->configRepository = $configRepository;
        $this->postRepository = $postRepository;
        $this->categoryServiceRepository = $categoryServiceRepository;
        $config = $this->configRepository->first();
        $config->banner_index = json_decode($config->banner_index);
        $config->banner_post = json_decode($config->banner_post);
        $list_service = $this->categoryServiceRepository->getList(['type' => 1,'status' => BaseModel::STATUS_ACTIVE],2);
        View::share([
            'config' => $config,
            'list_service' => $list_service
        ]);
    }

    public function index(Request $request){
        $posts = $this->postRepository->getList(['status' => BaseModel::STATUS_ACTIVE], 8);
        if($request->ajax()) {
            $posts = $this->postRepository->getList(['status' => BaseModel::STATUS_ACTIVE], 8);
        }
        return view('client.post.index', compact('posts'));
    }

    public function detail($slug = null){
        $params = explode('---',$slug);
        if(isset($params[1])){

            $post = $this->postRepository->getByID($params[1]);

            if(!$post){
                return redirect()->back()->withErrors('Vui lòng quay lại sau!');
            }

            $post_data = [
                'total_view' => $post->total_view + 1
            ];
            $this->postRepository->updatePost($post->id,$post_data);

            $post_relate = $this->postRepository->getList(['category' => $post->category,'status' => BaseModel::STATUS_ACTIVE],2);
            if(count($post_relate) < 2){
                $ids = [];
                foreach ($post_relate as $item){
                    array_push($ids,$item->id);
                }
                $post_relate_1 = Post::whereNotIn('id',$ids)->where('status',BaseModel::STATUS_ACTIVE)->limit(2-count($post_relate))->get();
                $post_relate = $post_relate->merge($post_relate_1);
            }

            return view('client.post.detail',compact('post','post_relate'));
        }
        return redirect()->back()->withErrors('Vui lòng quay lại sau!');
    }
}
