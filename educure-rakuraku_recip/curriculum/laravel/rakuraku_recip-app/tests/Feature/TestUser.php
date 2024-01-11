<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
        /** @test */
    public function a_user_can_add_a_recipe()
    {
        // ユーザーの作成や認証
        $user = User::factory()->create();
        $this->actingAs($user);

        // テスト用のレシピデータを作成
        $recipeData = [
            'title' => 'テストレシピ',
            'ingredients' => '材料1, 材料2',
            'quantity' => 4,
            'cooking_time' => 30,
            'description' => 'これはテストレシピです。',
            // 'cook_img' => アップロードする画像ファイルを作成する必要がある
        ];

        // フォームリクエストをシミュレートして`store`メソッドを呼び出す
        $response = $this->post(route('admin.recipes.store'), $recipeData);

        // データベースにレシピが保存されたことを確認
        $this->assertDatabaseHas('recipes', [
            'title' => 'テストレシピ',
            'ingredients' => '材料1, 材料2',
            'quantity' => 4,
            'cooking_time' => 30,
            'description' => 'これはテストレシピです。',
            // その他の必要なフィールド
        ]);

        // リダイレクトされることを確認
        $response->assertRedirect('/admin/recipes/create');
    }

}
