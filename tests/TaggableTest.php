<?php

namespace Vhnh\Taggable\Tests;

use Vhnh\Taggable\Tag;
use Vhnh\Taggable\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaggableTest extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return ['Vhnh\Taggable\ServiceProvider'];
    }

    /** @test */
    public function it_adds_tags_to_models()
    {
        $post = Post::create();
        $tag = Tag::create(['name' => 'example']);

        $post->tags()->attach($tag);

        $this->assertDatabaseHas('taggables', [
            'tag_id' => $tag->id,
            'taggable_id' => $post->id,
            'taggable_type' => Post::class,
        ]);
    }

    /** @test */
    public function it_retrives_the_models_from_a_tag()
    {
        $tag = Tag::create(['name' => 'example']);
        Post::create()->tags()->attach($tag);
        Post::create()->tags()->attach($tag);
        Post::create()->tags()->attach($tag);

        Post::create();

        $this->assertCount(3, $tag->taggables(Post::class)->get());
    }

    /** @test */
    public function it_retrieves_the_models_by_tagname()
    {
        $post = Post::create()->fresh();
        $post->tags()->attach(Tag::create(['name' => 'example']));

        $query = Post::whereTag('example');

        $this->assertCount(1, $query->get());
        
        $this->assertEquals(
            $post->toArray(),
            $query->first()->makeHidden('pivot')->toArray()
        );
    }
}

class Post extends Model
{
    use Taggable;
}
