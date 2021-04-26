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

    public function watchers(): hasManyThrough
    {
        return $this->hasManyThrough(User::class, Watch::class);
    }
}
