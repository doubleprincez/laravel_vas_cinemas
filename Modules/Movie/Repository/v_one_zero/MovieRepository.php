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


    /**
     * @inheritDoc
     */
    public function allPaginated(array $with = array())
    {
        // TODO: Implement allPaginated() method.
    }

    /**
     * @inheritDoc
     */
    public function getTown(array $with = null, $code = null)
    {
        // TODO: Implement getTown() method.
    }

    /**
     * @inheritDoc
     */
    public function getMoviesInCinema($cinema_id)
    {
        // TODO: Implement getMoviesInCinema() method.
    }

    public function latestMovies(array $with = array()): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model::with($with); // TODO: Change the autogenerated stub
        return $this->paginate($query->latest()->get());
    }

}
