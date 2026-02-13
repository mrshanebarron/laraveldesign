<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MrShaneBarron\LaravelDesign\Models\Category;
use MrShaneBarron\LaravelDesign\Models\Post;
use MrShaneBarron\LaravelDesign\Models\Tag;
use Tests\TestCase;

class CmsTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------
    // Public Routes
    // -------------------------------------------------------

    public function test_homepage_returns_200(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_blog_index_returns_200(): void
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
    }

    public function test_blog_show_returns_404_for_nonexistent_slug(): void
    {
        $response = $this->get('/blog/this-post-does-not-exist');

        $response->assertStatus(404);
    }

    public function test_admin_login_returns_200(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    // -------------------------------------------------------
    // Model: Post
    // -------------------------------------------------------

    public function test_can_create_a_post(): void
    {
        $post = Post::create([
            'title' => 'Test Blog Post',
            'type' => 'post',
            'content' => '<p>This is test content for a blog post.</p>',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertDatabaseHas('ld_posts', [
            'id' => $post->id,
            'title' => 'Test Blog Post',
            'slug' => 'test-blog-post',
            'type' => 'post',
            'status' => 'published',
        ]);
    }

    public function test_can_create_a_page(): void
    {
        $page = Post::create([
            'title' => 'About Us',
            'type' => 'page',
            'content' => '<p>About page content.</p>',
            'status' => 'published',
            'published_at' => now(),
            'template' => 'default',
        ]);

        $this->assertDatabaseHas('ld_posts', [
            'id' => $page->id,
            'title' => 'About Us',
            'slug' => 'about-us',
            'type' => 'page',
            'template' => 'default',
        ]);
    }

    public function test_can_create_a_category(): void
    {
        $category = Category::create([
            'name' => 'Laravel Tips',
            'description' => 'Tips and tricks for Laravel development.',
        ]);

        $this->assertDatabaseHas('ld_categories', [
            'id' => $category->id,
            'name' => 'Laravel Tips',
            'slug' => 'laravel-tips',
        ]);
    }

    public function test_post_auto_generates_slug(): void
    {
        $post = Post::create([
            'title' => 'My First Post With Spaces',
            'type' => 'post',
            'status' => 'draft',
        ]);

        $this->assertEquals('my-first-post-with-spaces', $post->slug);
    }

    public function test_post_scopes_filter_by_type(): void
    {
        Post::create(['title' => 'Blog Entry', 'type' => 'post', 'status' => 'draft']);
        Post::create(['title' => 'Static Page', 'type' => 'page', 'status' => 'draft']);

        $this->assertCount(1, Post::posts()->get());
        $this->assertCount(1, Post::pages()->get());
    }

    public function test_published_scope_filters_correctly(): void
    {
        Post::create([
            'title' => 'Published Post',
            'type' => 'post',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        Post::create([
            'title' => 'Draft Post',
            'type' => 'post',
            'status' => 'draft',
        ]);

        Post::create([
            'title' => 'Future Post',
            'type' => 'post',
            'status' => 'published',
            'published_at' => now()->addDay(),
        ]);

        $published = Post::published()->get();

        $this->assertCount(1, $published);
        $this->assertEquals('Published Post', $published->first()->title);
    }

    public function test_post_can_have_categories(): void
    {
        $post = Post::create(['title' => 'Categorized Post', 'type' => 'post', 'status' => 'draft']);
        $category = Category::create(['name' => 'PHP']);

        $post->categories()->attach($category);

        $this->assertCount(1, $post->fresh()->categories);
        $this->assertEquals('PHP', $post->fresh()->categories->first()->name);
    }

    public function test_post_can_have_tags(): void
    {
        $post = Post::create(['title' => 'Tagged Post', 'type' => 'post', 'status' => 'draft']);
        $tag = Tag::create(['name' => 'Tutorial']);

        $post->tags()->attach($tag);

        $this->assertCount(1, $post->fresh()->tags);
        $this->assertEquals('Tutorial', $post->fresh()->tags->first()->name);
    }

    public function test_category_auto_generates_slug(): void
    {
        $category = Category::create(['name' => 'Web Development']);

        $this->assertEquals('web-development', $category->slug);
    }

    public function test_tag_auto_generates_slug(): void
    {
        $tag = Tag::create(['name' => 'Best Practices']);

        $this->assertEquals('best-practices', $tag->slug);
    }
}
