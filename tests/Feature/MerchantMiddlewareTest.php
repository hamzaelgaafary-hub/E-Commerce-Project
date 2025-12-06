<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MerchantMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed the roles table so we can assign them
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
    }

    /** @test */
    public function a_guest_is_redirected_from_merchant_dashboard()
    {
        $this->get(route('merchant.dashboard'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function a_non_merchant_user_is_forbidden()
    {
        // Create a user with the 'user' role
        $userRole = Role::where('name', 'user')->first();
        $user = User::factory()->create([
            'role_id' => $userRole->id,
            'phone' => '1234567890',
            'location' => 'Test Location',
        ]);

        $this->actingAs($user)
            ->get(route('merchant.dashboard'))
            ->assertForbidden();
    }

    /** @test */
    public function a_merchant_user_can_access_the_merchant_dashboard()
    {
        // Create a user with the 'merchant' role
        $merchantRole = Role::where('name', 'merchant')->first();
        $merchant = User::factory()->create([
            'role_id' => $merchantRole->id,
            'phone' => '1234567890',
            'location' => 'Test Location',
        ]);

        $this->actingAs($merchant)
            ->get(route('merchant.dashboard'))
            ->assertOk();
    }
}
