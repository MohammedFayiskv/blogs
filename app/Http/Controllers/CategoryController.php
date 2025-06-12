<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::where('user_id', auth()->id())->get();
        return view('admin.category.category', compact('categories'));

    }

    public function create()
    {
        return view('admin.category.category-form');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $messages = [
            'cat_name.required' => 'Please enter a valid category name.',
            'display_name.required' => 'Please provide a display name for the category.',
            'cat_name.unique' => 'This category name is already taken. Please choose another one.',
            'display_name.unique' => 'This display name is already taken. Please choose another one.',
        ];
    
        $request->validate([
            'cat_name' => 'required|string|max:255|unique:categories,name,',
            'display_name' => 'nullable|string|max:255|unique:categories,display_name,',
            
        ], $messages);
    
        try {
      
            Category::create([
                'name' =>$request->cat_name ,
                'display_name' =>$request->display_name ,
                'user_id'=>$request->user_id = Auth::id(),

            ]);
    
            DB::commit();
    
            return redirect()->route('categories.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
           
            DB::rollBack();
    
            
            Log::error('Error while saving category: ' . $e->getMessage());
    
           
            return back()->with('error', 'An error occurred while creating the category. Please try again.');
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.category-form', compact('category'));
    }
    
    
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
    
      
        $messages = [
            'cat_name.required' => 'Please enter a valid category name.',
            'display_name.required' => 'Please provide a display name for the category.',
        ];
    
      
        $request->validate([
         'cat_name' => 'required|string|max:255|unique:categories,name,' . $id,
        'display_name' => 'nullable|string|max:255|unique:categories,display_name,' . $id,
        ], $messages);
    
        try {

            
            $category = Category::findOrFail($id);
            $category->update([
             'name' =>$request->cat_name ,
             'user_id'=>$request->user_id = Auth::id(),
                'display_name' =>$request->display_name ,
           
            ]);
    

            DB::commit();
    
            return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
           
            DB::rollBack();
    
            
            Log::error('Error while updating category: ' . $e->getMessage());
    
            return back()->with('error', 'An error occurred while updating the category. Please try again.');
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            
            $category = Category::findOrFail($id);
            $category->delete();

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error while deleting category: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while deleting the category. Please try again.');
        }
    }
}
    
    

