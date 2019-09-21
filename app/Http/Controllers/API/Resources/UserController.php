<?php

namespace App\Http\Controllers\API\Resources;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $this->authorize('adminAccess', new User());

        return response()->json(['result' => User::where($request->field, 'like', "%$request->search%")->select(['id', DB::raw('concat(name, " - " , email) as name')])->get()]);
    }
}
