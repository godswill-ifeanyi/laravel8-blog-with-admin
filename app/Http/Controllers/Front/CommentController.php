<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'comment_body' => 'required|string'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('message', 'Comment Area is Mandatory');
            }

            $post = Post::where('slug', $request->post_slug)->where('status','1')->first();
            if ($post) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'comment_body' => $request->comment_body
                ]);
                return redirect()->back()->with('message','Commented Successfully');
            }
            else {
                return redirect()->back()->with('message','No Such Post Found');    
            }
        }
        else {
            return redirect('/login')->with('message','Login first to comment');
        }
    }

    public function destroy(Request $request) {
        if (Auth::check()) {
            $comment = Comment::where('id',$request->comment_id)
            ->where('user_id',Auth::user()->id)
            ->first();

            if ($comment) {
                $comment->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Comment Deleted Successfully'
                ]);
            }
            else {
                return response()->json([
                    'status' => 200,
                    'message' => 'Comment Not Found'
                ]);
            }

        }
        else {
            return response()->json([
                'status' => 401,
                'message' => 'Login to Delete this Comment'
            ]);
        }
    }
}
