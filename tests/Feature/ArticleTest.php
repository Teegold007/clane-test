<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testsArticlesAreCreated()
    {
        $user = User::find(1);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
            'user_id'=>1
        ];

        $this->json('POST', '/api/v1/auth/articles',$payload, $headers)
            ->assertStatus(201)
        ->assertJsonStructure([
        'data' => [
            'title',
            'body',
            'ratings',
            'created_at',

        ],
    ]);
    }

    public function testsArticlesAreUpdatedCorrectly()
    {
        $user = User::find(1);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = Article::find(1);

        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

         $this->json('PUT', '/api/v1/auth/articles/' . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
            'data' => [
                'title',
                'body',
                'ratings',
                'created_at',

            ],
        ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
            'user_id'=> $user->id
        ]);

        $this->json('POST', '/api/v1/auth/articles/ ' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    public function testArticlesAreListedCorrectly()
    {


        $response = $this->json('GET', '/api/v1/articles')
            ->assertStatus(200);

    }

    public function testArticlesAreRatedCorrectly()
    {
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $payload = [
            'ratings' => 4

        ];

        $this->json('POST','/api/v1/articles/'.$article->id .'/rating' ,$payload)
            ->assertStatus(200)
        ->assertJsonStructure([
        'data' => [
            'title',
            'body',
            'ratings',
            'created_at',

        ],
    ]);
    }
}
