<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'blog_title',
        'blog_content' ,
        'blog_category_id' ,
        'blog_image' ,
          'user_id',
          'status',
          'published_at'

    ];

    protected $primaryKey = 'blog_id';



    
    public function items()
    {
        return $this->hasMany('App\Models\BlogTag','blgtag_blog_id','blog_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tags', 'blgtag_blog_id', 'blgtag_tag_id');
    }  



    

    public function category()
    {
        return $this->belongsTo('App\Models\Category','blog_category_id','id');
    }

}
