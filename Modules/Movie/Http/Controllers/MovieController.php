<?php

namespace Modules\Movie\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Movie\Contracts\MovieInterface as Repo;

class MovieController extends Controller
{
    protected Repo $repo;

    public function __construct(Repo $core)
    {
        $this->repo = $core;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(): Renderable
    {
        $movies = $this->repo->latestMovies(['genre']);
        return view('movie::index', compact('movies'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $movie = $this->repo->getMovie($id, ['genre', 'cinema', 'image']);
        return view('movie::show')->with(compact('movie'));
    }

}
