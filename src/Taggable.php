<?php

namespace Vhnh\Taggable;

trait Taggable
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public static function whereTag($name)
    {
        return Tag::fromName($name)
            ->taggables(get_called_class());
    }
}
