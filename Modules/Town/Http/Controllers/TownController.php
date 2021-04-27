<?php

namespace Modules\Town\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
//        return view('town::index');
    }

    public function changeTown()
    {
        $response = 'error';
        $message = 'Town not Found';
        if (request()->has('townId')) {
            $id = (int)request()->get('townId');
            // store new cinema in cookie session
            Cookie::queue('town', $id, 360);
            $cookie = \cookie('town', $id, 360);
            $response = 'success';
            $message = 'Town Set';
            notify()->success($message);

        } else {
            $cookie = Cookie::get('town');
            notify()->error($message);
        }
        return response()->json(compact('response', 'message'))->withCookie($cookie);
    }
}
