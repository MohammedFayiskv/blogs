<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'artcltag_tag_id',
        'artcltag_article_id',
    ];
    protected $primaryKey = 'artcltag_id';
    
}
