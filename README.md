![VHNH](https://avatars3.githubusercontent.com/u/66573047?s=200)

# vhnh/taggable

The Vhnh Taggable package allows to tag your Eloquent models.

![tests](https://github.com/vhnh/taggable/workflows/tests/badge.svg)

## The Taggable Trait

Tags are provided via a polymorphic many-to-many relationship. To setup the relationship you may want to use the `Vhnh\Taggable\Taggable` trait.

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vhnh\Taggable\Taggable;

class BlogPost extends Model
{
    use Taggable;
}
```

This traits methods return a `Illuminate\Database\Eloquent\Relations\Relation` instance which forward calls to `Illuminate\Database\Eloquent\Builder`.

## Retrieving Taggable Models

From a `Vhnh\Taggable\Tag` instance you may use the `taggables` method which also returns a  `Illuminate\Database\Eloquent\Relations\Relation` instance.

```php
Tag::fromName('recipe')->taggables(BlogPost::class)->get();
```

However, the `Vhnh\Taggable\Taggable` trait also provides a static `whereTag` method.

```php
BlogPost::whereTag('recipe')->get();
```

## License
The Vhnh Bookmark package is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT) license.