<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogTag;
use App\Models\Tag;

class FrondendController extends Controller
{
    public function singleblog($id)
{
    $blog = Blog::with(['category', 'items' => function ($qr) {
        $qr->select('blog_tags.*', 'tags.tag_name')
            ->join('tags', 'tag_id', 'blog_tags.blgtag_tag_id');
    }])->findOrFail($id);

    return view('frondend.single-post', compact('blog'));
}


public function displayBlogs(){

     $rltn = [
            'items' => function ($qr) {


                $qr->select('blog_tags.*', 'tags.tag_name')
                    ->join('tags', 'tag_id', 'blog_tags.blgtag_tag_id');
                
            },
        ];

          $blogs = Blog::with($rltn, 'category', 'user')->where('status','published')->latest()->paginate(10); 
        $tags = Tag::all();

         return view('frondend.blogs',compact('blogs','tags'));
   



}
}
