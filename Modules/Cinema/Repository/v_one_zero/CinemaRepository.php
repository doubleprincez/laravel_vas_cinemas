<?php


namespace Modules\Cinema\Repository\v_one_zero;


use Illuminate\Database\Eloquent\Collection;
use Modules\Cinema\Contracts\CinemaInterface;
use Modules\Cinema\Entities\Cinema;
use Modules\Core\Repository\CoreRepository;
use Modules\Movie\Entities\Movie;
use Modules\Town\Entities\Town;

class CinemaRepository extends CoreRepository implements CinemaInterface
{
    public function __construct(Cinema $model)
    {
        $this->model = $model;

        $this->current_page = request()->has('page') ? (int)request()->get('page') : 1;
    }

    public function all(array $with = array(), array $where = array())
    {
        $town = $this->getTown(['cinemas', 'cinemas.image']);
        return $query = $town->cinemas;
    }


    public function allPaginated(array $with = array(), array $where = array())
    {
        $town = $this->getTown(['cinemas', 'cinemas.image']);
        $query = $town->cinemas;
        return $this->paginate($query);
    }

    /**
     * Display cinema centers in chosen location
     * @param array|null $with
     * @param null $code
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     */

    public function getTown(array $with = null, $code = null)
    {
        $default_town = env('DEFAULT_TOWN', 'lagos');
        if ($code) {
            $query = $this->getModel(new Town())::with($with)->where('code', $code);
        } elseif (request()->has('town')) {
            $filter = $this->filter(request()->get('town'));
            $query = $this->getModel(new Town())::with($with)->where('code', $filter);
        } else {
            // default town
            $query = $this->getModel(new Town())::with($with)->where('code', $default_town);
        }

        return $query->first();
    }

    /**
     * @param $cinema_id
     */
    public function getMoviesInCinema($cinema_id): \Illuminate\Pagination\LengthAwarePaginator
    {
        $movies = $this->model::with(['movies' => function ($movies) {
            $movies->where('available', 1);
        }, 'movies.genre', 'movies.image'])->where('id', $cinema_id)->firstOrFail()->movies;
        if ($movies) return $this->paginate($movies, $this->per_page, $this->current_page);
    }

    public function findById($id, array $with = array())
    {
        return parent::findById($id, $with); // TODO: Change the autogenerated stub
    }

    public function latestMovies(array $with = array())
    {
        $query = $this->getModel(new Movie())::with($with); // TODO: Change the autogenerated stub
        return $this->paginate($query->latest()->get());
    }
}
