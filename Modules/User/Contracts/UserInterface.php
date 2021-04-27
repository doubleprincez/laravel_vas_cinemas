<?php


namespace Modules\User\Contracts;


use Modules\Core\Contracts\CoreInterface;

interface UserInterface extends CoreInterface
{

    /** Check the number of seats left
     * @param $cinema_id
     * @return int|mixed
     */
    public function check_cinema_capacity($cinema_id);


    /**
     * Use Show Details to Fetch Number of Watchers
     * @param $cinema_id
     * @param $movie_id
     * @param $start_time
     * @return mixed
     */
    public function get_raw_watchers($cinema_id, $movie_id, $start_time);

    /** Get a list of watched movie by current user grouped by cinema center
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */

    public function watched();


}
