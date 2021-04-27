<?php


namespace Modules\Cinema\Contracts;


use Modules\Core\Contracts\CoreInterface;

interface CinemaInterface extends CoreInterface
{

    /**
     * Get the current town view
     *
     * @param array|null $with
     * @param null $code
     * @return mixed
     */
    public function getTown(array $with = array(), $code = null);

    /**
     * Get all towns record
     * @return mixed
     */
    public function allTowns();

    /**
     * Use the Cinema id to find movies in that cinema
     * @param $cinema_id
     * @return mixed
     */
    public function getMoviesInCinema($cinema_id);
}
