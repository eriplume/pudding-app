<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesControllerTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->article = Article::factory()->create();
    }
    
    public function test_user_can_add_favorite()
    {
        $response = $this->actingAs($this->user)->post("/articles/{$this->article->id}/favorites");
        
        $response->assertRedirect();
        
        $this->assertDatabaseHas('favorites', [
            'user_id' => $this->user->id,
            'article_id' => $this->article->id,
        ]);
    }
    
    public function test_user_can_remove_favorite()
    {
        // まずお気に入りしておく
        $this->user->favorite($this->article->id);
        
        $response = $this->actingAs($this->user)->delete("/articles/{$this->article->id}/unfavorite");
        
        $response->assertRedirect();
        
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $this->user->id,
            'article_id' => $this->article->id,
        ]);
    }
}
