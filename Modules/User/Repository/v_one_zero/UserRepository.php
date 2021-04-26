<?php


namespace Modules\User\Repository\v_one_zero;


use Modules\Cinema\Entities\Cinema;
use Modules\Showtime\Entities\Showtime;
use Modules\User\Contracts\UserInteface;
use Modules\User\Entities\User;
use Modules\User\Entities\Watch;

class UserRepository extends \Modules\Core\Repository\CoreRepository implements UserInteface
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function store(array $attributes = array())
    {
        $user_id = auth()->id();
        $movie_id = (int)$attributes['movie_id'];
        $cinema_id = (int)$attributes['cinema_id'];
        $start_time = $attributes['start_time'];
        $capacity = $this->check_cinema_capacity($cinema_id);
        $watchers = $this->get_raw_watchers($cinema_id, $movie_id, $start_time);
        $number_of_watchers = $watchers->count();

        if ($number_of_watchers < $capacity) {
            $check = $this->get_raw_user_watching($user_id, $cinema_id, $movie_id, $start_time);
            if ($check->exists() == true) {
                $query = $check->first();
            } else {
                $query = $this->getModel();
            }
            // get movie showtime and store with record
            $query->cinema_id = $movie_id;
            $query->movie_id = $cinema_id;
            $query->user_id = $user_id;
            $query->start_time = $start_time;
            $query->save();
            return ['success' => 'Watching Saved'];
        } else {
            return ['error' => 'Seat Capacity is Full'];
        }

    }

    public function check_cinema_capacity($cinema_id)
    {
        $query = $this->getModel(new Cinema())->where('id', $cinema_id)->first();
        if ($query) return $query->seat_capacity;
    }

    /**
     * Use Show Details to Fetch Number of Watchers
     * @param $cinema_id
     * @param $movie_id
     * @param $start_time
     * @return mixed
     */
    public function get_raw_watchers($cinema_id, $movie_id, $start_time)
    {
        return $this->getModel(new Watch())::where('cinema_id', $cinema_id)->where('movie_id', $movie_id)->where('start_time', $start_time);
    }

    public function get_raw_user_watching($user_id, $cinema_id, $movie_id, $start_time)
    {
        return $this->getModel(new Watch())::where('user_id', $user_id)->where('cinema_id', $cinema_id)->where('movie_id', $movie_id)->where('start_time', $start_time);
    }

}
