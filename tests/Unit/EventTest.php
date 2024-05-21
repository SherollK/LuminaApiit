<?php

use App\Models\Events;
use App\Models\User;
use Tests\TestCase;

class EventTest extends TestCase
{
    /////////////////////////////////////////////////////////////////     USER TESTS

    /**
     * Test that a USER can access the events page.
     */
    public function testEventScreenCanBeRendered(): void
    {
        $response = $this->get('/events');

        $response->assertStatus(200);//access granted
    }

    /**
     * Test that a USER cannot access the events admin page.
     */
    public function testUserCannotAccessEventPage()
    {
        $user = User::factory()->create([
            'role' => 'USER', //setting role to USER
        ]);

        $this->actingAs($user)->get('/admin/events')
            ->assertStatus(403); //forbidden access
    }

    /**
     * Test that a USER cannot access the events create page.
     */
    public function testUserCannotAccessCreateEventPage()
    {
        $user = User::factory()->create([
            'role' => 'USER', //set role to USER
        ]);

        $this->actingAs($user)->get('/admin/events/create')
            ->assertStatus(403); //forbidden access
    }

    /**
     * Test that a USER cannot access the events edit page.
     */
    public function testUserCannotAccessEditEventPage()
    {
        $user = User::factory()->create([
            'role' => 'USER', //set role to USER
        ]);

        $this->actingAs($user)->get('/admin/events/{slug}/edit')
            ->assertStatus(403); //forbidden access
    }

    /////////////////////////////////////////////////////////////////     ADMIN TESTS

    /**
     * Test that a ADMIN can access the events page.
     */
    public function testEventScreenCanBeRenderedByAdmin(): void
    {
        $adminRoles = ['ADMIN']; //array of allowed admin roles

        foreach ($adminRoles as $role) {
            $user = User::factory()->create([
                'role' => $role,
            ]);

            $response = $this->actingAs($user)->get('/events');

            $response->assertStatus(200); //access granted for each admin role
        }
    }

    /**
     * Test that a ADMIN can access the events admin page.
     */
    public function testAdminCanAccessEventPage()
    {
        $user = User::factory()->create([
            'role' => 'ADMIN', //setting role to ADMIN
        ]);

        $this->actingAs($user)->get('/admin/events')
            ->assertStatus(200); //access granted
    }

    /**
     * Test that a ADMIN can access the events create page.
     */
    public function testAdminCanAccessCreateEventPage()
    {
        $user = User::factory()->create([
            'role' => 'ADMIN', //set role to ADMIN
        ]);

        $this->actingAs($user)->get('/admin/events/create')
            ->assertStatus(200); //access granted
    }

    /**
     * Create dummy event and check if it has slug.
     */
    public function testEventHasSlug(){
        $event = Events::factory()->create(); //create an event with a slug

        $this->assertNotNull($event->slug); //check if event has a slug
    }

    /**
     * Test that a ADMIN can access the events edit page using an existing event.
     */
    /*public function testAdminCanAccessEditEventPage()
    {
        $user = User::factory()->create([
            'role' => 'ADMIN', //set role to ADMIN
        ]);

        // Retrieve the seeded event instead of creating a new one
        $slug = Events::first(); // Adjust selector based on your slug

        $this->actingAs($user)->get('admin/events/' . $slug . '/edit')
            ->assertStatus(200); //access granted
    }*/


}
