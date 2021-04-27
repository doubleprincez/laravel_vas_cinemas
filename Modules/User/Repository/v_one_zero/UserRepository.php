<?php


namespace Modules\User\Repository\v_one_zero;


use Modules\Cinema\Entities\Cinema;
use Modules\Showtime\Entities\Showtime;
use Modules\User\Contracts\UserInterface;
use Modules\User\Entities\User;
use Modules\User\Entities\Watch;

class UserRepository extends \Modules\Core\Repository\CoreRepository implements UserInterface
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /** Store new watch record
     * @param array $attributes
     * @return mixed|string[]
     */
    public function store(array $attributes = array())
    {
        $type = 'error';
        $message = 'Seat Capacity is Full';
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
                $query = $this->getModel(new Watch());
                $query->user_id = $user_id;
            }
            // get movie showtime and store with record
            $query->cinema_id = $cinema_id;
            $query->movie_id = $movie_id;
            $query->start_time = $start_time;
            $query->save();
            $message = 'Watching Saved';
            $type = 'success';
            notify()->success($message);
            return [$type => $message];
        }
        notify()->error($message);
        return [$type => $message];

    }

    /** Get the number of seats for the cinema
     * @param $cinema_id
     * @return int|mixed
     */
    public function check_cinema_capacity($cinema_id)
    {
        $query = $this->getModel(new Cinema())->where('id', $cinema_id)->first();
        if ($query) return $query->seat_capacity;
        return 0;
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

    /**
     * Check if the user is currently going to watch the movie at the cinema
     * @param $user_id
     * @param $cinema_id
     * @param $movie_id
     * @param $start_time
     * @return mixed
     */
    public function get_raw_user_watching($user_id, $cinema_id, $movie_id, $start_time)
    {
        return $this->getModel(new Watch())::where('user_id', $user_id)->where('cinema_id', $cinema_id)->where('movie_id', $movie_id)->where('start_time', $start_time);
    }

    /**
     * Get a list of movies watched by current user
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function watched()
    {
        $user_id = auth()->id();
        $query = $this->getModel(new Watch())->with(['cinema', 'movie', 'movie.genre', 'movie.image']);
        return $query->where('user_id', $user_id)->latest()->get()->groupBy('cinema.name');
    }

    /**
     * Cancel a watch request
     * @param array $attributes
     * @return array
     */
    public function cancel(array $attributes = array()): array
    {
        $type = 'error';
        $message = 'Deleted already';
        $user_id = auth()->id();
        $movie_id = (int)$attributes['movie_id'];
        $cinema_id = (int)$attributes['cinema_id'];
        $start_time = $attributes['start_time'];

        $check = $this->get_raw_user_watching($user_id, $cinema_id, $movie_id, $start_time);
//        dd(Watch::where('user_id', $user_id)->get());
        if ($check->count() > 0) {
            $check->delete();
            $type = 'success';
            $message = 'You are no more watching this movie';
            notify()->success($message);
            return [$type => $message];
        }
        notify()->error($message);
        return [$type => $message];
    }
}
