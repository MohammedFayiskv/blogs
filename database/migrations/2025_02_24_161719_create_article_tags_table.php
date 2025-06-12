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
        Schema::create('article_tags', function (Blueprint $table) {
            $table->id('artcltag_id');
            $table->foreignId('artcltag_article_id')->nullable()->constrained('articles', 'artcl_id') ->onDelete('cascade');
            $table->foreignId('artcltag_tag_id')->nullable()->constrained('tags', 'tag_id') ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_tags');
    }
};
