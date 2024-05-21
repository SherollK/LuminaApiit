<?php

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /////////////////////////////////////////////////////////////////     USER TESTS

    /**
     * Test that a USER can access the posts page.
     */
    public function testPostsScreenCanBeRendered(): void
    {
        $response = $this->get('/posts');

        $response->assertStatus(200);//access granted
    }

    /**
     * Test that a USER cannot access the events admin page.
     */
    public function testUserCannotAccessPostPage()
    {
        $user = User::factory()->create([
            'role' => 'USER', //setting role to USER
        ]);

        $this->actingAs($user)->get('/admin/posts')
            ->assertStatus(403); //forbidden access
    }

    /**
     * Test that a USER cannot access the events create page.
     */
    public function testUserCannotAccessCreatePostPage()
    {
        $user = User::factory()->create([
            'role' => 'USER', //set role to USER
        ]);

        $this->actingAs($user)->get('/admin/posts/create')
            ->assertStatus(403); //forbidden access
    }

    /////////////////////////////////////////////////////////////////     ADMIN TESTS

    /**
     * Test that a ADMIN can access the posts page.
     */
    public function testPostScreenCanBeRenderedByAdmin(): void
    {
        $adminRoles = ['ADMIN']; //array of allowed admin roles

        foreach ($adminRoles as $role) {
            $user = User::factory()->create([
                'role' => $role,
            ]);

            $response = $this->actingAs($user)->get('/posts');

            $response->assertStatus(200); //access granted for each admin role
        }
    }

    /**
     * Test that a ADMIN can access the posts admin page.
     */
    public function testAdminCanAccessPostsPage()
    {
        $user = User::factory()->create([
            'role' => 'ADMIN', //setting role to ADMIN
        ]);

        $this->actingAs($user)->get('/admin/posts')
            ->assertStatus(200); //access granted
    }

    /**
     * Create dummy event and check if it has slug.
     */
    public function testPostHasSlug()
    {
        $post = Post::factory()->create(); //create an event with a slug

        $this->assertNotNull($post->slug); //check if event has a slug
    }


}
