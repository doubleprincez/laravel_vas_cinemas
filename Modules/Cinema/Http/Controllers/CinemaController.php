<?php

namespace Modules\Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cinema\Contracts\CinemaInterface as Repo;

class CinemaController extends Controller
{
    public Repo $repo;

    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource from the core repository interface
     */
    public function index()
    {
        $cinemas = $this->repo->allPaginated();
        $town = $this->repo->getTown();
        $towns = $this->repo->allTowns();
        return view('cinema::index')->with(compact('cinemas', 'town', 'towns'));
    }

    /**
     * Show the form for creating a new resource.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $cinema = $this->repo->findById($id);
        $movies = $this->repo->getMoviesInCinema($cinema->id);

        return view('cinema::show')->with(compact('cinema', 'movies'));
    }

}
