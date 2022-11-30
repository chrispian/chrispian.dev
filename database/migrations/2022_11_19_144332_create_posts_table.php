<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_order')->nullable();;
            $table->foreignId('author_id')->constrained('users');
            $table->string('title');
            $table->string('slug');
            $table->text('cover_image')->nullable();
            $table->text('summary');
            $table->json('content');
            $table->string('status')->default('draft');
            $table->foreignId('project_id');
            $table->foreignId('series_id');
            $table->json('related_posts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
