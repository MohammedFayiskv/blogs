<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id('blgtag_id');
            $table->foreignId('blgtag_blog_id')->nullable()->constrained('blogs', 'blog_id') ->onDelete('cascade');
            $table->foreignId('blgtag_tag_id')->nullable()->constrained('tags', 'tag_id') ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_tags');
    }
};
