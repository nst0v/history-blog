<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('filename'); // имя файла на диске
            $table->string('original_name'); // оригинальное имя файла
            $table->string('mime_type'); // тип файла
            $table->string('path'); // путь к файлу
            $table->bigInteger('size'); // размер в байтах
            $table->json('metadata')->nullable(); // размеры изображения, alt текст и т.д.
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
