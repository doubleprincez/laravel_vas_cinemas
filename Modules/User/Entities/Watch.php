<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Cinema\Entities\Cinema;
use Modules\Movie\Entities\Movie;

/**
 * Class Watch
 * @package Modules\User\Entities
 *
 * @property int user_id
 * @property int cinema_id
 * @property int movie_id
 * @property mixed start_time
 */
class Watch extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\WatchFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }
}
