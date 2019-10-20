<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Vinh Cuong
 * Date: 29/08/2018
 * Time: 11:12 SA
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function uploadImage(Request $request)
    {
        $img_path = $request->file('file')->store('', 'upload_folder');

        return Response()->json(['location' => url('/uploads/' . $img_path)]);
    }

}
