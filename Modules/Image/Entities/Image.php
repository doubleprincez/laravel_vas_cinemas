<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Image\Database\factories\ImageFactory::new();
    }

    public function imageable()
    {
        return $this->morphTo();
    }

}
