<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class indexFetchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->json('GET', 'api/fetchMypageInfo/1', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
