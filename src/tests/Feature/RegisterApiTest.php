<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertJson;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */

    public function ユーザーを作成してレスポンスを返す()
    {   
        $this->withoutExceptionHandling();
        $data = [
            'name' => 'test_user',
            'email' => 'test@gmail.com',
            'password' => 'Pass12345',
            'password_confirmation' => 'Pass12345'
        ];

        $response = $this->json('POST', route('register'), $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);

        $response
            ->assertStatus(201)
            ->assertJson(['name' => $user->name]);
    }
}
