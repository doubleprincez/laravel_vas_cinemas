<?php


namespace Modules\Core\Repository;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Modules\Town\Entities\Town;


abstract class CoreRepository
{
    protected Model $model;
    protected int $per_page = 12;
    protected int $current_page = 1;

    /**
     * get current Model
     *
     * @param Model|null $model
     * @return Model
     */
    public function getModel(Model $model = null): Model
    {
        if ($model) {
            return $this->model = $model;
        }
        return $this->model;
    }

    /**
     * Filer incoming string value
     * @param $variable
     * @return mixed
     */
    public function filter($variable)
    {
        return filter_var(trim($variable), FILTER_SANITIZE_STRING);
    }

    /**
     * Fetch all records
     * @param array $with
     * @return mixed
     */
    public function all(array $with = array())
    {
        $query = $this->relation($with);
        return $query->get();
    }

    /**
     * find specific record
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function findById($id, array $with = array())
    {
        $query = $this->relation($with)->where('id', $id);
        return $query->firstOrFail();
    }

    /**
     * Find by slug
     * @param $slug
     * @param array $with Model relationship
     * @param array $where Add other query ties e.g where published = 1
     * @return mixed
     */
    public function findBySlug($slug, array $with = array(), array $where = array())
    {
        $query = $this->relation($with)->where('slug', $slug)->where($where);
        return $query->firstOrFail();
    }

    /**
     * fetch using relationship
     *
     * @param array $with
     * @return mixed
     */
    public function relation(array $with = array())
    {
        return $this->model::with($with);
    }

    /**
     * Length Paginate results before rendering
     *
     * @param Collection $collection
     * @param $per_page
     * @param $current_page
     */
    public function paginate(Collection $collection, $per_page = null, $current_page = null)
    {
        $offset = $collection->forPage($this->current_page, $this->per_page);
        $total = count($collection);
        return new LengthAwarePaginator($offset, $total, $this->per_page, Paginator::resolveCurrentPage(), ['path' => Paginator::resolveCurrentPath()]);
    }


    public function latest(array $with = array())
    {
        $query = $this->relation($with);
        return $this->paginate($query->latest()->get());
    }


    public function allPaginated(array $with = array(), array $where = array())
    {
        return $this->paginate($this->relation($with)->where([$where])->get()); // TODO: Implement allPaginated() method.
    }


    public function store(array $attributes = array())
    {
        return $this->getModel()->firstOrCreate($attributes);
    }

    public function update($id, array $attributes = array())
    {
        return $this->findById($id)->update($attributes);
    }
}
