<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Contracts\UserInteface as Repo;

class UserController extends Controller
{
    protected Repo $repo;

    public function __construct(Repo $repo)
    {
        $this->middleware('auth');
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('user::index');
    }

    /**User can view all movies they have watched
     *
     */
    public function watch()
    {
        dd(request()->all());
        return;
    }

    public function store_watch()
    {
        $store = $this->repo->store(request()->all());
        return back()->with($store);
    }
}
