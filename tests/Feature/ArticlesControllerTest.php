<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArticlesControllerTest extends TestCase
{
    use RefreshDatabase;
    
    //各テストケース毎に実行する
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();
        $this->articles = Article::factory()->count(3)->create(['user_id' => $this->user->id]);
    }
    
    public function test_user_can_view_article_pages()
    {
        $user = User::factory()->create();
        
        //指定のAuthenticatableユーザとして実行する
        $response = $this->actingAs($this->user)->get('/articles');
        
        $response->assertStatus(200);
        
        $response->assertViewIs('articles.index');
        
        $response->assertViewHas('articles');
        
        $articles = $response->viewData('articles');
        $this->assertCount(3, $articles);
    }
    
    public function test_create_page_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)->get('/articles/create');

        $response->assertStatus(200);
        $response->assertViewIs('articles.create');
    }
    
    public function test_new_articles_can_stored(): void
    {
        $user = User::factory()->create();

        //テスト用の仮想ストレージに保存させる
        Storage::fake('public');

        // ダミーの画像ファイルを作成
        $file = UploadedFile::fake()->image('test_image.jpg');

        $data = [
            'title' => 'Test Title',
            'type_id' => 1,
            'shop' => 'Test Shop',
            'pref_id' => 1,
            'content' => 'Test content',
            'address' => 'Test address',
            'image' => $file,
        ];
        
        // 記事投稿リクエストを送信
        $response = $this->actingAs($this->user)->post('/articles', $data);

        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Successfully!');
        
        // データベースに記事が保存されていることを確認
        $this->assertDatabaseHas('articles', [
            'title' => 'Test Title',
            'type_id' => 1,
            'shop' => 'Test Shop',
            'pref_id' => 1,
            'content' => 'Test content',
            'address' => 'Test address',
        ]);
        
        // 画像が指定のディレクトリに保存されていることを確認
        Storage::disk('public')->assertExists('img/' . $file->hashName());
    }
    
    public function test_user_can_edit_their_own_article()
    {
        $article = $this->articles->first();

        $response = $this->actingAs($this->user)->get("/articles/{$article->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('articles.edit');
        $response->assertViewHas('article', $article);
    }
    
    public function test_user_can_update_their_own_article()
    {
        $article = $this->articles->first();
        $data = [
            'title' => 'Updated Title',
            'type_id' => 1,
            'shop' => 'Updated Shop',
            'pref_id' => 1,
            'content' => 'Updated content',
            'address' => 'Updated address',
        ];

        $response = $this->actingAs($this->user)->put("/articles/{$article->id}", $data);

        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Successfully updated!');

        $this->assertDatabaseHas('articles', ['id' => $article->id, 'title' => 'Updated Title']);
    }
    
    public function test_user_can_delete_their_own_article()
    {
        $article = $this->articles->first();

        $response = $this->actingAs($this->user)->delete("/articles/{$article->id}");

        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Successfully deleted.');

        // データベスからレコードが消えていることを確認
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
}
