<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $historicalTags = [
            // Персоны
            'Наполеон', 'Цезарь', 'Александр Македонский', 'Клеопатра', 'Петр I',
            'Екатерина II', 'Иван Грозный', 'Карл Великий', 'Ричард Львиное Сердце',
            'Ганнибал', 'Спартак', 'Нерон', 'Константин', 'Юстиниан',

            // Места
            'Рим', 'Египет', 'Греция', 'Византия', 'Персия', 'Китай', 'Индия',
            'Месопотамия', 'Галлия', 'Британия', 'Скандинавия', 'Испания',

            // События
            'Крестовые походы', 'Столетняя война', 'Великие географические открытия',
            'Реформация', 'Возрождение', 'Просвещение', 'Революция', 'Пунические войны',

            // Периоды
            'Античность', 'Раннее средневековье', 'Высокое средневековье',
            'Позднее средневековье', 'Ренессанс', 'Барокко', 'Классицизм',

            // Темы
            'Археология', 'Архитектура', 'Искусство', 'Религия', 'Мифология',
            'Торговля', 'Дипломатия', 'Наука', 'Технологии', 'Быт', 'Оружие',
            'Замки', 'Храмы', 'Монастыри', 'Рыцарство', 'Крестьянство'
        ];

        // Используем unique() для избежания дублирования
        $name = fake()->unique()->randomElement($historicalTags);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => fake()->optional(0.6)->sentence(),
            'color' => fake()->hexColor(),
            'posts_count' => 0, // Будет обновляться автоматически
        ];
    }
}
