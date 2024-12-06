<?php

namespace Database\Factories;

use App\Models\Category;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $discount = [0.10, 0.05, 0.15];
        $category = Category::all()->pluck('id')->toArray();

        $name = $this->faker->words(2, true);
        $client = new Client();
        $imageUrl = 'https://picsum.photos/400/200';
        $imageName = 'Product/' . Str::slug($name) . '.jpg';
        $response = $client->get($imageUrl);
        Storage::put('public/' . $imageName, $response->getBody());

        return [
            'name' => $name,
            'description' => $this->faker->text(150),
            'price' => $this->faker->randomFloat(2, 20, 500),
            'discount' => $this->faker->randomElement($discount),
            'stock' => $this->faker->numberBetween(5, 14),
            'category_id' => $this->faker->randomElement($category),
            'photo_path' => $imageName,
        ];
    }
}
