<?php

namespace Modules\Movie\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Cinema\Entities\Cinema;
use Modules\Image\Entities\Image;
use Modules\User\Entities\User;
use Modules\User\Entities\Watch;

/**
 * @property mixed id
 * @property mixed genre_id
 * @property mixed title
 * @property mixed movie_length
 * @property mixed release_year
 * @property mixed available
 * @property mixed description
 */
class Movie extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Movie\Database\factories\MovieFactory::new();
    }

    public function image(): morphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function genre(): belongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function cinema(): belongsToMany
    {
        return $this->belongsToMany(Cinema::class, 'showtimes', 'movie_id', 'cinema_id')->withPivot(['start_time']);
    }

    public function format_movie(array $with = array())
    {
        if (auth()->check()) {
            $select = Watch::where('user_id', auth()->id());
            if ($select->count() > 0) {
                $watched = collect($select->get(['cinema_id', 'movie_id']));
//                $watched = $all_watched->contains($this->id);
            } else {
                $watched = false;
            }
        } else {
            $watched = false;
        }
        $relations = $this->load($with);

        // format movie to include if user has watched the movie before
        return json_decode(json_encode($relations->toArray() + ["watched" => $watched]));

    }

    public function watchers(): hasManyThrough
    {
        return $this->hasManyThrough(User::class, Watch::class);
    }
}
