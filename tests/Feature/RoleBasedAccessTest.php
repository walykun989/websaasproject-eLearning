<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleBasedAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_peserta_can_access_peserta_dashboard(): void
    {
        $user = User::where('email', 'budi@example.com')->first();

        $response = $this->actingAs($user)
            ->get(route('peserta.dashboard'));

        $response->assertStatus(200);
    }

    public function test_pengajar_can_access_pengajar_dashboard(): void
    {
        $user = User::where('role', 'pengajar')->first();

        $response = $this->actingAs($user)
            ->get(route('pengajar.dashboard'));

        $response->assertStatus(200);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $user = User::where('role', 'admin')->first();

        $response = $this->actingAs($user)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    public function test_peserta_cannot_access_pengajar_dashboard(): void
    {
        $user = User::where('email', 'budi@example.com')->first();

        $response = $this->actingAs($user)
            ->get(route('pengajar.dashboard'));

        $response->assertStatus(403);
    }

    public function test_peserta_cannot_access_admin_dashboard(): void
    {
        $user = User::where('email', 'budi@example.com')->first();

        $response = $this->actingAs($user)
            ->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_pengajar_cannot_access_admin_dashboard(): void
    {
        $user = User::where('role', 'pengajar')->first();

        $response = $this->actingAs($user)
            ->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_pengajar_cannot_access_peserta_routes(): void
    {
        $user = User::where('role', 'pengajar')->first();

        $response = $this->actingAs($user)
            ->get(route('peserta.catalog.index'));

        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_peserta_routes(): void
    {
        $user = User::where('role', 'admin')->first();

        $response = $this->actingAs($user)
            ->get(route('peserta.catalog.index'));

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get(route('peserta.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_users_have_correct_default_role(): void
    {
        $newUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $newUser->refresh();

        $this->assertEquals('peserta', $newUser->role);
    }

    public function test_check_role_middleware_blocks_unauthorized_access(): void
    {
        $pesertaUser = User::where('email', 'budi@example.com')->first();

        $response = $this->actingAs($pesertaUser)
            ->get(route('admin.users.index'));

        $response->assertStatus(403);
    }

    public function test_multiple_roles_can_be_assigned(): void
    {
        $adminUser = User::where('role', 'admin')->first();
        $pengajarUser = User::where('role', 'pengajar')->first();
        $pesertaUser = User::where('role', 'peserta')->first();

        $this->assertEquals('admin', $adminUser->role);
        $this->assertEquals('pengajar', $pengajarUser->role);
        $this->assertEquals('peserta', $pesertaUser->role);
    }
}
