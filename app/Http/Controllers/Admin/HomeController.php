<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardV1()
    {
        $products = DB::table('product')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get(['total','status'])->all();
        return view('admin.dashboard.dashboard',compact('products'));
    }
}
