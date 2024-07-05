<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // ユーザーとそのユーザーの記事３件を作成
        $this->user = User::factory()->create();
        $this->articles = Article::factory()->count(3)->create(['user_id' => $this->user->id]);
        
        // 他のユーザーと、このユーザーのお気に入り記事を設定
        $this->otherUser = User::factory()->create();
        foreach($this->articles as $article) {
            $this->otherUser->favorite($article->id);
        }
    }
    
    public function test_user_can_view_their_favorites_article()
    {
        $response = $this->actingAs($this->otherUser)->get("/users/{$this->otherUser->id}/favorites");
        $response->assertStatus(200);
        $response->assertViewIs('users.favorites');
        $response->assertViewHas('articles');
        
        $favorites = $response->viewData('articles');
        $this->assertCount(3, $favorites);
    }
    
    public function test_user_can_view_their_articles()
    {
        $response = $this->actingAs($this->user)->get("/users/{$this->user->id}/articles");
        $response->assertStatus(200);
        $response->assertViewIs('users.articles');
        $response->assertViewHas('articles');
        
        $articles = $response->viewData('articles');
        $this->assertCount(3, $articles);
    }
}
