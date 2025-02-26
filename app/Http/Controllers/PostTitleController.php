<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostTitle;
use Illuminate\Support\Facades\Validator;

class PostTitleController extends Controller
{

    public function fetch()
    {
        $posts = PostTitle::with('parent')->get();
        return response()->json(['posts' => $posts]);
    }

    
    public function index()
    {
        $posttitles= PostTitle::with('parent')->get();

      
        return view ('PostTitle.index',compact('posttitles'));
    }

    // Store a new post title
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = PostTitle::create($request->all());
        return response()->json(['message' => 'عنوان پستی باموفقیت ثبت گردید!', 'post' => $post]);
    }

    // Show a specific post title
    public function show($id)
    {
        return PostTitle::findOrFail($id);
    }

    // Update an existing post title
    public function update(Request $request, $id)
    {
        $postTitle = PostTitle::findOrFail($id);

        $postTitle->update($request->all());
        return response()->json($postTitle);
    }

    // Delete a post title
    public function destroy($id)
    {
        $postTitle = PostTitle::findOrFail($id);
        $postTitle->delete();

        return response()->json(['message' => 'عنوان پستی باموفقیت حذف گردید!']);
    }
}
