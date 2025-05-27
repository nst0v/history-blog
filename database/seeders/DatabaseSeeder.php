<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаем администратора
        $admin = User::factory()->admin()->create([
            'name' => 'Администратор',
            'email' => 'admin@history-blog.com',
            'bio' => 'Главный редактор исторического блога'
        ]);

        // Создаем авторов
        $authors = User::factory()->author()->count(3)->create();

        // Создаем обычных пользователей
        User::factory()->count(10)->create();

        // Создаем категории (не больше 12, чтобы не превысить список)
        $categories = Category::factory()->count(8)->create();

        // Создаем теги (не больше количества в массиве)
        $tags = Tag::factory()->count(25)->create();

        // Создаем посты
        $posts = collect();

        // Посты от администратора
        $adminPosts = Post::factory()
            ->count(5)
            ->published()
            ->create([
                'user_id' => $admin->id,
                'category_id' => $categories->random()->id
            ]);
        $posts = $posts->merge($adminPosts);

        // Посты от авторов
        foreach ($authors as $author) {
            $authorPosts = Post::factory()
                ->count(fake()->numberBetween(3, 6))
                ->create([
                    'user_id' => $author->id,
                    'category_id' => $categories->random()->id
                ]);
            $posts = $posts->merge($authorPosts);
        }

        // Создаем несколько избранных постов
        $featuredPosts = Post::factory()
            ->featured()
            ->count(3)
            ->create([
                'user_id' => $admin->id,
                'category_id' => $categories->random()->id
            ]);
        $posts = $posts->merge($featuredPosts);

        // Привязываем теги к постам
        $posts->each(function ($post) use ($tags) {
            $randomTags = $tags->random(fake()->numberBetween(1, 4));
            $post->tags()->attach($randomTags);
        });

        // Обновляем счетчики постов в тегах
        $tags->each(function ($tag) {
            $tag->updatePostsCount();
        });

        $this->command->info('✅ Создано:');
        $this->command->info('👥 Пользователей: ' . User::count());
        $this->command->info('📂 Категорий: ' . Category::count());
        $this->command->info('🏷️  Тегов: ' . Tag::count());
        $this->command->info('📝 Постов: ' . Post::count());
        $this->command->info('📰 Опубликованных постов: ' . Post::published()->count());
        $this->command->info('⭐ Избранных постов: ' . Post::where('is_featured', true)->count());
    }
}
