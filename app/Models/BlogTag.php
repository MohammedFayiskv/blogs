<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'blgtag_tag_id',
        'blgtag_blog_id',
        
    ];
    protected $primaryKey = 'blgtag_id';
    
}
