<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{

    public function dashboard(){
        return view('admin.index');

    }

public function fetchBlogs(Request $request)
{
       $query = Blog::with([
        'category',
        'items' => function ($query) {
            $query->select('blog_tags.*', 'tags.tag_name')
                  ->join('tags', 'tag_id', '=', 'blog_tags.blgtag_tag_id');
        }
    ]);

    if ($request->title) {
        $query->where('blog_title', 'like', '%' . $request->title . '%');
    }
    if ($request->category) {
        $query->where('blog_category_id', $request->category);
    }
    if ($request->tag) {
        $query->whereHas('tags', function ($q) use ($request) {
            $q->where('tag_id', $request->tag);
        });
    }
    if ($request->status) {
        $query->where('status', $request->status);
    }

    $blogs = $query->paginate(10);
    
    return response()->json([
        'blogs' => view('admin.Blog.partials.blog_table', compact('blogs'))->render(),
        'pagination' => $blogs->withQueryString()->links()->render()
    ]);
}




    public function index(Request $request)
{
    $query = Blog::with([
        'category',
        'items' => function ($query) {
            $query->select('blog_tags.*', 'tags.tag_name')
                  ->join('tags', 'tag_id', '=', 'blog_tags.blgtag_tag_id');
        }
    ])
    ->where('user_id', auth()->id());

 $blogs = $query->paginate(10)->withQueryString();
   
    $categories = Category::where('user_id', auth()->id())->get();
    $tags = Tag::where('user_id', auth()->id())->get();

    return view('admin.Blog.blog-list', compact('blogs', 'categories', 'tags'));
}


    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        $tags = Tag::where('user_id', auth()->id())->get(); 
        return view('admin.Blog.blog-form', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Please enter an Blog name',
            'description.required' => 'Please enter some description' ,
            'blog_image.image' => 'The uploaded file must be an image',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'blog_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ], $messages);

        DB::beginTransaction();

        try {
           
            $blog['blog_title'] = $request->name;
            $blog['blog_content'] =strip_tags($request->description);
             $blog['status'] ='draft';
              $blog['user_id']=$request->user_id = Auth::id();
            $blog['blog_category_id']= isset($request->category_id)&&($request->category_id) ? $request->category_id : null;
            if ($request->hasFile('blog_image')){
                $image = $request['blog_image'];
                $destinationPath = 'images/blogs';
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $name);
                $blog['blog_image'] = $destinationPath . '/' . $name;
            }
            
           
            $data = Blog::create($blog);
           
                if ($request->has('tags')) {
                    
                    $lastBlog = Blog::latest()->first();
                    foreach ($request->tags as $tag) {
                        $data = BlogTag::create([
                            'blgtag_tag_id'=>$tag,
                            'blgtag_blog_id'=> $lastBlog->blog_id
                           
                        ]);

                    }
        
            }
        
          

    

            DB::commit();
            return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating Blog: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while creating the Blog. Please try again later or contact the web team if the issue persists' );
        }
    }

    public function edit( $id)

    {

        $blog = Blog::with('items')->find($id);
         $categories = Category::where('user_id', auth()->id())->get();
          $tags = Tag::where('user_id', auth()->id())->get();  
        return view('admin.Blog.blog-form', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        
        $messages = [
            'name.required' => 'Please enter an Blog name.',
            'image.image' => 'The uploaded file must be an image.',
        ];
    
       
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);
    
        DB::beginTransaction();
    
        try {
          
            $blog = Blog::where('blog_id', $id)->first();
    
            if (!$blog) {
                return back()->with('error', 'Blog not found!');
            }
    
          
            $updateData = [
                'blog_title' => $request->name,
                'blog_content' =>strip_tags($request->description),
                 'status' =>'draft',
                'blog_category_id' => $request->category_id ?? null, 
                 'user_id'=>$request->user_id = Auth::id(),
            ];
    
            
            
            if ($request->hasFile('blog_image')) {
               
                if ($blog->blog_image && file_exists(public_path($blog->blog_image))) {
                    
                    unlink(public_path($blog->blog_image));
                }
    
               
                $image = $request->file('blog_image');
                $destinationPath = 'images/blogs';
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($destinationPath), $name);
    
                
                $updateData['blog_image'] = $destinationPath . '/' . $name;
            }
    
          
            $blog->update($updateData);

          
            BlogTag::where('blgtag_blog_id', $blog->blog_id)->delete();
    
            if ($request->has('tags') && $request->tags) {
                foreach ($request->tags as $tag) {
                    BlogTag::create([
                        'blgtag_tag_id' => $tag,
                        'blgtag_blog_id' => $blog->blog_id,
                    ]);
                }
            }
    
            DB::commit();
    
            return redirect()->route('blogs.index')->with('success', 'blog updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating blog: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the blog. Please try again later or contact the web team if the issue persists');
        }
    }
    

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $blog = Blog::findOrFail($id);

           
              
            if ($blog->blog_image && file_exists(public_path($blog->blog_image))) {
                    
                unlink(public_path($blog->blog_image));
            }
            $articleTag=BlogTag::where('blgtag_blog_id', $blog->blog_id)->delete();

            
            $blog->delete();

            DB::commit();
            return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting blog: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the blog. Please try again.Please try again later or contact the web team if the issue persists');
        }
    }


    public function publish(Request $request)
{
     $blog = Blog::where('blog_id', $request->id)->first();
    if ($blog) {
        $blog->status = 'published';
         $blog->published_at = now();
        $blog->save();

        return response()->json(['success' => true, 'message' => 'Blog published successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Blog not found.'], 404);
}





}

