<?php

namespace Modules\Cinema\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Image\Entities\Image;
use Modules\Movie\Entities\Movie;

/**
 * Class Cinema
 * @package Modules\Cinema\Entities
 *
 * @property integer town_id
 * @property mixed name
 * @property mixed manager_id
 * @property mixed address
 * @property mixed phone
 * @property mixed seat_capacity
 * @property mixed other_details
 * @property boolean in_use
 */
class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Cinema\Database\factories\CinemaFactory::new();
    }

    /**
     * Get the post's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'showtimes', 'cinema_id', 'movie_id');
    }
}
