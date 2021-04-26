<?php

namespace Modules\Town\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cinema\Entities\Cinema;

class Town extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Town\Database\factories\TownFactory::new();
    }

    public function cinemas()
    {
        return $this->hasMany(Cinema::class);
    }
}
