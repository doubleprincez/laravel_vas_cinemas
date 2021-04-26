<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cinema\Contracts\CinemaInterface as Repo;


class CoreController extends Controller
{
    protected Repo $repo;

    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $movies = $this->repo->latestMovies(['genre']);
        return view('welcome')->with(compact('movies'));
    }

    public function home()
    {
        $movies = $this->repo->latestMovies(['genre']);
        return view('welcome')->with(compact('movies'));
    }

}
