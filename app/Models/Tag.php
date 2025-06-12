<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_name',
        'tag_display_name' ,
    ];
    protected $primaryKey = 'tag_id';

    // public function articles()
    // {
    //     return $this->belongsToMany(Article::class, 'article_tags', 'artcltag_tag_id', 'artcltag_article_id');
    // }
}
