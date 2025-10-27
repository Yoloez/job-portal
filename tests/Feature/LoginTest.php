<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin login redirects to admin.index
     */
    public function test_admin_login_redirects_to_admin_index(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect(route('admin.index'));
        $this->assertAuthenticatedAs($admin);
    }

    /**
     * Test non-admin user cannot access admin.index
     */
    public function test_non_admin_cannot_access_admin_index(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $this->actingAs($user);

        $response = $this->get('/admin/index');

        $response->assertRedirect('/login');
    }

    /**
     * Test admin can access admin.index
     */
    public function test_admin_can_access_admin_index(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $response = $this->get('/admin/index');

        $response->assertStatus(200);
    }
}
