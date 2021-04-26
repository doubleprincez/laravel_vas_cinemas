<?php

namespace Modules\Movie\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cinema\Entities\Cinema;
use Modules\Image\Entities\Image;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Movie\Database\factories\MovieFactory::new();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function cinema()
    {
        return $this->belongsToMany(Cinema::class, 'showtimes', 'movie_id', 'cinema_id')->withPivot(['start_time']);
    }
}
