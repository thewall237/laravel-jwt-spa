<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    private $accessToken = null;
    
    protected function setUp(): Void // ※ Voidが必要
    {   
        // 必ずparent::setUp()を呼び出す
        parent::setUp(); 
        // 1.ログインユーザー作成
        User::create([
            'name' => 'test_user',
            'email' => 'test@gmail.com',
            'password' => Hash::make('Pass12345'),
        ]);
        // 2.ログインAPIでアクセストークン取得
        $response = $this->post('/api/login', [
            'email' => 'test@gmail.com',
            'password' => 'Pass12345'
        ]);

        $response->assertOk();
        // 3.アクセストークンを変数に保存しておく
        $this->accessToken = $response->json('access_token');
    }

    /**
     * @test
     * @group testing
     */
    public function 認証テスト()
    {   
        $response = $this->get('/api/me', [
            'Authorization' => 'Bearer '.$this->accessToken
        ]);

        $response->assertOk()->assertJsonFragment([
            'name' => 'test_user'
        ]);
    }
}
