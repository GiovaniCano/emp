<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $writer = User::whereHas('roles', function ($query) {
                $query->where('name', 'writer');
            })->inRandomOrder()->first();

        return [
            'user_id' => $writer->id,
            'title' => $this->faker->sentence,
            'content' => $this->generateContent()
        ];
    }
    
    /**
     * Generate more complex content with HTML tags.
     *
     * @return string
     */
    private function generateContent(): string
    {
        $paragraphs = $this->faker->paragraphs(5);

        $content = '<img src="asdasd.jpg" alt="Image">';
        
        foreach ($paragraphs as $paragraph) {
            $content .= "<p>{$paragraph}</p>";
        }

        $content .= '<img src="asdasd.jpg" alt="Image">';

        return $content;
    }
}
