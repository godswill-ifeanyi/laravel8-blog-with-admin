<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PostFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index() {
        $post = Post::all();
        return view('admin.post.index', compact('post'));
    }

    public function create() {
        $category = Category::where('front_status','1')->get();
        return view('admin.post.create', compact('category'));
    }

    public function store(PostFormRequest $request) {
        $data = $request->validated();

        $post = new Post;

        $post->name = $data['name'];
        $post->slug = Str::slug($data['name']);
        $post->description = $data['description'];

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = uniqid() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('uploads/post/'), $filename);
            $post->image_path = $filename;
        }

        $post->yt_iframe = $data['yt_iframe'];
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        $post->status = $request->status == true ? '1' : '0';
        $post->category_id = $data['category_id'];
        $post->created_by = Auth::user()->id;

        $post->save();

        return redirect('admin/posts')->with('message', 'Post Added Successfully');
    }

    public function edit($post_id) {
        $category = Category::where('front_status','1')->get();
        $post = Post::find($post_id);
        return view('admin.post.edit', compact('category','post'));
    }

    public function update(Request $request, $post_id) {
        $data = $request->validate([
            'category_id' => ['required','integer'],
            'name' => ['required','string','max:200'],
            'slug' => ['nullable','string','max:200'],
            'description' => ['required'],
            'image_path' => ['nullable','mimes:jpg,png,jpeg'],
            'yt_iframe' => ['nullable','string','max:200'],
            'meta_title' => ['required','string','max:200'],
            'meta_description' => ['nullable'],
            'meta_keyword' => ['nullable'],
            'status' => ['nullable'],
        ]);

        $post = Post::find($post_id);

        $post->name = $data['name'];
        $post->slug = Str::slug($data['name']);
        $post->description = $data['description'];

        if ($request->hasfile('image')) {
            $destination = 'uploads/category/'.$post->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename = uniqid() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('uploads/post/'), $filename);
            $post->image_path = $filename;
        }

        $post->yt_iframe = $data['yt_iframe'];
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        $post->status = $request->status == true ? '1' : '0';
        $post->category_id = $data['category_id'];
        $post->created_by = Auth::user()->id;

        $post->update();

        return redirect('admin/posts')->with('message', 'Post Updated Successfully');
    }

    public function destroy(Request $request) {
        $post = Post::find($request->post_id);

        if ($post) {
            $destination = 'uploads/post/'.$post->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
             
            $post->delete();

            return redirect('admin/posts')->with('message', 'Post Deleted Successfully');
        } else {
            return redirect('admin/posts')->with('message', 'No Post Found');
        }
    }
}
