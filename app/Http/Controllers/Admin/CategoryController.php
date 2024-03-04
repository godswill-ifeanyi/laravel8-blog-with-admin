<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CategoryFormRequest;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index() {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request) {

        $data = $request->validated();

        $category = new Category;

        $category->name = $data['name'];
        $category->slug = Str::slug($data['name']);
        $category->description = $data['description'];

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = uniqid() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category/'), $filename);
            $category->image_path = $filename;
        }

        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keyword'];

        $category->front_status = $request->front_status == true ? '1' : '0';
        $category->admin_status = $request->admin_status == true ? '1' : '0';
        $category->user_id = Auth::user()->id;

        $category->save();

        return redirect('admin/category')->with('message', 'Category Added Successfully');
    }

    public function edit($category_id) {
        $category = Category::find($category_id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $category_id) {
        $data = $request->validate([
            'name' => ['required','string','max:200'],
            'slug' => ['nullable','string','max:200'],
            'description' => ['required'],
            'image_path' => ['nullable','mimes:jpg,png,jpeg'],
            'meta_title' => ['required','string','max:200'],
            'meta_description' => ['required','string'],
            'meta_keyword' => ['required','string'],
            'front_status' => ['nullable'],
            'admin_status' => ['nullable'],
        ]); # validating a form without having to create a request

        $category = Category::find($category_id);

        $category->name = $data['name'];
        $category->slug = Str::slug($data['name']);
        $category->description = $data['description'];

        if ($request->hasfile('image')) {
            $destination = 'uploads/category/'.$category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename = uniqid() .'.'. $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category/'), $filename);
            $category->image_path = $filename;
        }

        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword = $data['meta_keyword'];

        $category->front_status = $request->front_status == true ? '1' : '0';
        $category->admin_status = $request->admin_status == true ? '1' : '0';
        $category->user_id = Auth::user()->id;

        $category->update();

        return redirect('admin/category')->with('message', 'Category Updated Successfully');
    }

    public function destroy(Request $request) {
        $category = Category::find($request->category_id);

        if ($category) {
            $destination = 'uploads/category/'.$category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
             
            $category->delete();

            return redirect('admin/category')->with('message', 'Category And All Associated Posts Deleted Successfully');
        } else {
            return redirect('admin/category')->with('message', 'No Category Found');
        }
    }
}
