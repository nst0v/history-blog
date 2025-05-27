<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image'); // путь к изображению баннера
            $table->string('link_url')->nullable(); // ссылка при клике
            $table->enum('position', ['header', 'sidebar', 'footer', 'content'])->default('header');
            $table->integer('sort_order')->default(0); // порядок отображения
            $table->boolean('is_active')->default(true);
            $table->timestamp('starts_at')->nullable(); // дата начала показа
            $table->timestamp('ends_at')->nullable(); // дата окончания показа
            $table->integer('clicks_count')->default(0); // статистика кликов
            $table->integer('views_count')->default(0); // статистика просмотров
            $table->timestamps();

            // Индексы
            $table->index(['is_active', 'position']);
            $table->index(['starts_at', 'ends_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
