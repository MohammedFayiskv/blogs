<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'artcl_name',
        'artcl_description' ,
        'artcl_category_id' ,
        'artcl_image' ,

    ];

    protected $primaryKey = 'artcl_id';



    
    public function items()
    {
        return $this->hasMany('App\Models\ArticleTag','artcltag_article_id','artcl_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'artcltag_article_id', 'artcltag_tag_id');
    }  



    

    public function category()
    {
        return $this->belongsTo('App\Models\Category','artcl_category_id','id');
    }

}
