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


    /**Fetch latest movies
     * @param array $with
     * @return mixed
     */
    public function latest(array $with = array());

    /**
     * Create new Record
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes = array());

    /**
     * Update Previous record using the record's ID
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes = array());


}
