<?php

namespace Database\Factories;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2, true);
        $client = new Client();
        $imageUrl = 'https://picsum.photos/400/200';
        $imageName = 'Category/' . Str::slug($name) . '.jpg';
        $response = $client->get($imageUrl);
        Storage::put('public/' . $imageName, $response->getBody());

        return [
            'name' => $name,
            'description' => $this->faker->text(150),
            'image_path' => $imageName,
        ];
    }
}
