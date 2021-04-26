<?php

namespace Modules\Showtime\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cinema\Entities\Cinema;
use Modules\Movie\Entities\Movie;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Showtime\Database\factories\ShowtimeFactory::new();
    }

    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }
}
