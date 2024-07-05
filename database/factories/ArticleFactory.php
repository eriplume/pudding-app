<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('ja_JP'); // 日本語ローカライゼーションを使用
        
        $titles = ['カフェプリン', '喫茶店プリン', 'テイクアウトプリン'];
        
        $types = array_keys(config('pudding_types'));
        $prefs = array_keys(config('pref'));
        
        return [
            'title' => $faker->randomElement($titles),
            'type_id' => $faker->randomElement($types),
            'shop' => $faker->company, 
            'pref_id' => $faker->randomElement($prefs), 
            'content' => $faker->sentence,
            'address' => $faker->streetAddress,
            'image' => 'images/test_image.jpg',
            'user_id' => \App\Models\User::factory(),
        ];

    }
}
