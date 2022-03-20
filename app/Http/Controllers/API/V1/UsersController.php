<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UsersResource;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        return new UsersResource($request->user());
    }

}
