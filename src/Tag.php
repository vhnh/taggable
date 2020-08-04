<?php

namespace Vhnh\Taggable;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function scopeFromName($query, $name)
    {
        return $query->where(compact('name'))->firstOrFail();
    }

    public function taggables($class)
    {
        return $this->morphedByMany($class, 'taggable');
    }
}
