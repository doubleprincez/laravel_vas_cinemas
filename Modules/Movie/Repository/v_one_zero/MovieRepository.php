<?php


namespace Modules\Movie\Repository\v_one_zero;


use Modules\Core\Repository\CoreRepository;
use Modules\Movie\Contracts\MovieInterface;
use Modules\Movie\Entities\Movie;

class MovieRepository extends CoreRepository implements MovieInterface
{
    public function __construct(Movie $model)
    {
        $this->model = $model;
    }


    public function latestMovies(array $with = array()): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model::with($with); // TODO: Change the autogenerated stub
        return $this->paginate($query->latest()->get());
    }

    public function getMovie($id, array $with = array())
    {
        $movie = $this->findById($id, $with);

        return $movie->format_movie($with);
    }

}
