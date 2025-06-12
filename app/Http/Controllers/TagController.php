<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index()
    {
         $tags = Tag::where('user_id', auth()->id())->get();
        return view('admin.tags.taglist', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.tag-form'); 
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $messages = [
            'tag_name.required' => 'Please enter a tag name.',
            'display_name.required' => 'Please provide a display name for the tag.',
            'tag_name.unique' => 'This tag name is already taken. Please choose another one.',
            'display_name.unique' => 'This display name is already taken. Please choose another one.',
        ];

      
        $request->validate([
            'tag_name' => 'required|string|max:255|unique:tags,tag_name',
            'display_name' => 'nullable|string|max:255|unique:tags,tag_display_name',
        ], $messages);

        try {
          
            Tag::create([

                "tag_name"=> $request->tag_name,
                "tag_display_name"=> $request->display_name
            ]);

            DB::commit();
            return redirect()->route('tags.index')->with('success', 'Tag created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error while saving tag: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while creating the tag. Please try again.');
        }
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id); 
        return view('admin.tags.tag-form', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();


        $messages = [
            'tag_name.required' => 'Please enter a tag name.',
            'display_name.required' => 'Please provide a display name for the tag.',
            'tag_name.unique' => 'This tag name is already taken. Please choose another one.',
            'display_name.unique' => 'This display name is already taken. Please choose another one.',
        ];

       
        $request->validate([
            'tag_name' => 'required|string|max:255|unique:tags,tag_name,' . $id .',tag_id',
            'display_name' => 'nullable|string|max:255|unique:tags,tag_display_name,' . $id .',tag_id',
        ], $messages);

        try {
           
            $tag = Tag::findOrFail($id);
            $tag->update([
                "tag_name"=> $request->tag_name,
                "tag_display_name"=> $request->display_name

            ]);

            DB::commit();
            return redirect()->route('tags.index')->with('success', 'Tag updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error while updating tag: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the tag. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            
            $tag = Tag::findOrFail($id);
            $tag->delete();

            return redirect()->route('tags.index')->with('success', 'Tag deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting tag: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the tag. Please try again.');
        }
    }
}
