<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    private static $usedCategories = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $historicalCategories = [
            'Древний мир' => ['description' => 'История древних цивилизаций', 'color' => '#8B4513'],
            'Средневековье' => ['description' => 'Эпоха рыцарей и замков', 'color' => '#2F4F4F'],
            'Новое время' => ['description' => 'Эпоха великих открытий', 'color' => '#B8860B'],
            'Военная история' => ['description' => 'Великие битвы и сражения', 'color' => '#8B0000'],
            'Археология' => ['description' => 'Находки и открытия', 'color' => '#CD853F'],
            'Биографии' => ['description' => 'Жизнь исторических личностей', 'color' => '#4682B4'],
            'Культура и искусство' => ['description' => 'Культурное наследие', 'color' => '#9932CC'],
            'Религия и мифология' => ['description' => 'Верования и легенды', 'color' => '#DAA520'],
            'Наука и технологии' => ['description' => 'Научные открытия прошлого', 'color' => '#2E8B57'],
            'Повседневная жизнь' => ['description' => 'Быт и традиции', 'color' => '#CD5C5C'],
            'Экономика и торговля' => ['description' => 'Торговые пути и экономика', 'color' => '#4169E1'],
            'Дипломатия' => ['description' => 'Международные отношения', 'color' => '#8A2BE2'],
        ];

        // Получаем доступные категории (еще не использованные)
        $availableCategories = array_diff_key($historicalCategories, self::$usedCategories);

        // Если все категории использованы, создаем уникальную
        if (empty($availableCategories)) {
            $categoryName = 'Категория ' . fake()->unique()->numberBetween(1000, 9999);
            $slug = Str::slug($categoryName);

            return [
                'name' => $categoryName,
                'slug' => $slug,
                'description' => fake()->sentence(),
                'color' => fake()->hexColor(),
                'icon' => fake()->optional(0.5)->randomElement([
                    'fas fa-crown', 'fas fa-shield-alt', 'fas fa-scroll',
                    'fas fa-monument', 'fas fa-chess-rook', 'fas fa-globe'
                ]),
                'parent_id' => null,
                'sort_order' => fake()->numberBetween(0, 100),
                'is_active' => fake()->boolean(95),
            ];
        }

        // Выбираем случайную доступную категорию
        $categoryName = array_rand($availableCategories);
        $categoryData = $availableCategories[$categoryName];

        // Отмечаем как использованную
        self::$usedCategories[$categoryName] = true;

        $slug = Str::slug($categoryName);

        return [
            'name' => $categoryName,
            'slug' => $slug,
            'description' => $categoryData['description'],
            'color' => $categoryData['color'],
            'icon' => fake()->optional(0.5)->randomElement([
                'fas fa-crown', 'fas fa-shield-alt', 'fas fa-scroll',
                'fas fa-monument', 'fas fa-chess-rook', 'fas fa-globe'
            ]),
            'parent_id' => null,
            'sort_order' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(95),
        ];
    }
}
