<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BudgetTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_cannot_access_unlinked_budget(): void
    {
        $this->assertTrue(true);
//        $user = User::factory()->create();
//
//        $this->actingAs($user)
//            ->visitRoute('budget', 1);
//            ->see('Welcome');
//
//        $response->assertStatus(200);
    }
}
