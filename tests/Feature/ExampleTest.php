<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Guests are redirected from the root to the dashboard (which then
     * redirects to login) rather than seeing a public homepage.
     */
    public function test_the_root_redirects_to_the_dashboard(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/dashboard/index');
    }

    public function test_the_login_page_is_reachable(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
