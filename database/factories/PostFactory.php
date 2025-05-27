<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $historicalTitles = [
            'Тайны древнеегипетских пирамид',
            'Падение Римской империи: причины и последствия',
            'Жизнь в средневековом замке',
            'Великие географические открытия XV века',
            'Битва при Ватерлоо: поворотный момент истории',
            'Культура Византийской империи',
            'Археологические открытия в Помпеях',
            'Крестовые походы: религия и политика',
            'Повседневная жизнь в Древней Греции',
            'Секреты алхимиков Средневековья',
            'Викинги: мореплаватели и воины',
            'Искусство эпохи Возрождения',
            'Загадки Стоунхенджа',
            'Империя инков: достижения и гибель',
            'Рыцарские турниры в Средние века'
        ];

        $title = fake()->randomElement($historicalTitles);
        $slug = Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 9999);

        $content = $this->generateHistoricalContent();
        $excerpt = Str::limit(strip_tags($content), 200);

        $publishedAt = fake()->boolean(80) ? fake()->dateTimeBetween('-2 years', 'now') : null;
        $status = $publishedAt ? 'published' : fake()->randomElement(['draft', 'published']);

        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $excerpt,
            'content' => $content,
            'featured_image' => fake()->optional(0.7)->imageUrl(800, 400, 'history'),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'status' => $status,
            'published_at' => $publishedAt,
            'views_count' => fake()->numberBetween(0, 5000),
            'comments_count' => fake()->numberBetween(0, 50),
            'meta_data' => [
                'meta_title' => $title,
                'meta_description' => $excerpt,
                'keywords' => fake()->words(5, true)
            ],
            'is_featured' => fake()->boolean(20), // 20% избранных
            'allow_comments' => fake()->boolean(90),
        ];
    }

    private function generateHistoricalContent(): string
    {
        $paragraphs = [];

        // Введение
        $paragraphs[] = fake()->paragraph(4);

        // Основная часть (3-5 параграфов)
        for ($i = 0; $i < fake()->numberBetween(3, 5); $i++) {
            $paragraphs[] = fake()->paragraph(fake()->numberBetween(3, 6));
        }

        // Заключение
        $paragraphs[] = fake()->paragraph(3);

        return '<p>' . implode('</p><p>', $paragraphs) . '</p>';
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}
