<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // краткое описание
            $table->longText('content');
            $table->string('featured_image')->nullable(); // главное изображение
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // автор
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->integer('views_count')->default(0);
            $table->integer('comments_count')->default(0); // кеш количества комментариев
            $table->json('meta_data')->nullable(); // SEO данные (title, description, keywords)
            $table->boolean('is_featured')->default(false); // рекомендуемый пост
            $table->boolean('allow_comments')->default(true);
            $table->timestamps();

            // Индексы для производительности
            $table->index(['status', 'published_at']);
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
