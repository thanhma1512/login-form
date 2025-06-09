<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'tags')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->hasFile('image'), $request->file('image')); 
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts' , 'public');
        }

        // dd($imagePath, str_replace('public/', '', $imagePath));
        $post = Auth::user()->posts()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-') . '-' . uniqid(),
            'content' => $request->content,
            'image' => str_replace('public/', '', $imagePath),
            'is_published' => $request->has('is_published'),
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        Log::info('Post created', [
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'title' => $post->title,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $selectedTags = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $imagePath = $post->image;

        if ($request->hasFile('image')) {

            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
           
            $imagePath = $request->file('image')->store('posts' , 'public');
           
            $imagePath = str_replace('public/', '', $imagePath);

        } elseif ($request->input('clear_image')) {
           
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
           
            $imagePath = null;
        }

        $slug = $post->slug;
        if ($request->title !== $post->title) {
            $slug = Str::slug($request->title, '-') . '-' . uniqid();
        }

        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
            'is_published' => $request->has('is_published'),
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        Log::info('Post updated', [
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'title' => $post->title,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        Log::info('Post deleted', [
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'title' => $post->title,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa thành công!');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:posts,id',
        ]);

        $post_ids = $request->input('ids');
        $deletedCount = 0;

        foreach ($post_ids as $id) {
            $post = Post::find($id);
            if ($post) {
        

                if ($post->image && Storage::disk('public')->exists($post->image)) {
                    Storage::disk('public')->delete($post->image);
                }
                $post->delete();
                $deletedCount++;

                Log::info('Post bulk deleted', [
                    'post_id' => $post->id,
                    'user_id' => Auth::id(),
                    'title' => $post->title,
                ]);
            }
        }

        if ($deletedCount > 0) {
            return redirect()->route('admin.posts.index')->with('success', "Đã xóa thành công $deletedCount bài viết.");
        } else {
            return redirect()->route('admin.posts.index')->with('error', 'Không có bài viết nào được xóa.');
        }
    }
}
