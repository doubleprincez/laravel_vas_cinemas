<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\User\Contracts\UserInterface as Repo;

class UserController extends Controller
{
    protected Repo $repo;

    public function __construct(Repo $repo)
    {
        $this->middleware('auth');
        $this->repo = $repo;
    }

    /**
     * Store New user watch
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store_watch(): \Illuminate\Http\RedirectResponse
    {
        $valid = Validator::make(request()->all(), [
            'movie_id' => 'required',
            'cinema_id' => 'required',
            'start_time' => 'required'
        ]);
        if ($valid->fails()) {
            return back()->with(['error' => 'Unable to Watch Movie']);
        }
        $store = $this->repo->store(request()->all());
        return back()->with($store);
    }

    public function cancel_watch()
    {
        $valid = Validator::make(request()->all(), [
            'movie_id' => 'required',
            'cinema_id' => 'required',
            'start_time' => 'required'
        ]);
        if ($valid->fails()) {
            return back()->with(['error' => 'Unable to Watch Movie']);
        }
        $cancel = $this->repo->cancel(request()->all());
        return back()->with($cancel);
    }

    public function watched()
    {
        $watched = $this->repo->watched();
        return view('user::watched')->with(compact('watched'));
    }
}
