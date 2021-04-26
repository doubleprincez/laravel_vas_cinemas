<?php


namespace Modules\Core\Contracts;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CoreInterface
{
    /**
     * Fetch all records
     * @param array $with
     * @return mixed
     */
    public function all(array $with = array());

    /**
     * Paginate all fetched record
     * @param array $with
     * @return mixed
     */
    public function allPaginated(array $with = array());


    /**
     * find specific record
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function findById($id, array $with = array());

    /**
     * Find by slug
     * @param $slug
     * @param array $with
     * @return mixed
     */
    public function findBySlug($slug, array $with = array());

    /**
     * fetch using relationship
     *
     * @param array $with
     * @return mixed
     */
    public function relation(array $with = array());

    /**
     * Length Paginate results before rendering
     *
     * @param Collection $collection
     * @param $per_page
     * @param $current_page
     * @return mixed
     */
    public function paginate(Collection $collection, $per_page = null, $current_page = null);

    /**
     * Get the current town view
     *
     * @param array|null $with
     * @param null $code
     * @return mixed
     */
    public function getTown(array $with = null, $code = null);

    /**
     * Get all towns record
     * @param array $with
     * @return mixed
     */
    public function allTowns(array $with = array());

    /**
     * Use the Cinema id to find movies in that cinema
     * @param $cinema_id
     * @return mixed
     */
    public function getMoviesInCinema($cinema_id);

    /**Fetch latest movies
     * @param array $with
     * @return mixed
     */
    public function latest(array $with = array());
}
