<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        $category = Category::where('front_status','1')->where('admin_status','1')->get();
        $post = Post::where('status','1')->take(6)->orderBy('created_at','DESC')->get();
        return view('front.index',compact('category','post'));
    }

    public function view_category($category_slug) {
        $category = Category::where('slug',$category_slug)->where('front_status','1')->first();

        if ($category) {
            $post = Post::where('category_id',$category->id)->where('status','1')->orderBy('created_at','DESC')->paginate(6);
            return view('front.post.index', compact('post','category'));
        }
        else {
            return redirect('/');
        }

        return view('front.post.index',compact('category'));
    }

    public function view_post($category_slug, $post_slug) {
        $category = Category::where('slug',$category_slug)->where('front_status','1')->first();

        if ($category) {
            $post = Post::where('category_id',$category->id)->where('slug',$post_slug)->where('status','1')->first();
            $latest_posts = Post::where('category_id',$category->id)->where('status','1')->orderBy('created_at','DESC')->take(6)->get();
            return view('front.post.view', compact('category','post','latest_posts'));
        }
        else {
            return redirect('/');
        }

        return view('front.index',compact('category'));
    }
    
}
