<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index() {
        $setting = Setting::find(1);
        return view('admin.setting.index', compact('setting'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'website_name' => 'required|string|max:255',
            'website_logo' => 'nullable',
            'website_favicon' => 'nullable',
            'description' => 'nullable',
            'meta_title' => 'required|max:255',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', 'All Field Are Required');
        }

        $setting = Setting::where('id','1')->first();

        if ($setting) {
            
            $setting->website_name = $request->website_name;

            if ($request->hasfile('website_logo')) {
                $destination = 'uploads/setting/'.$setting->logo;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('website_logo');
                $filename = uniqid() .'.'. $file->getClientOriginalExtension();
                $file->move('uploads/setting/', $filename);
                $setting->logo = $filename;
            }

            if ($request->hasfile('website_favicon')) {
                $destination = 'uploads/setting/'.$setting->favicon;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('website_favicon');
                $filename = uniqid() .'.'. $file->getClientOriginalExtension();
                $file->move('uploads/setting/', $filename);
                $setting->favicon = $filename;
            }

            $setting->description = $request->description;
            $setting->meta_title = $request->meta_title;
            $setting->meta_description = $request->meta_description;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->update();

            return redirect('admin/settings')->with('message', 'Settings Updated!');
        } else {
            $setting = new Setting;
            $setting->website_name = $request->website_name;

            if ($request->hasfile('website_logo')) {
                $file = $request->file('website_logo');
                $filename = uniqid() .'.'. $file->getClientOriginalExtension();
                $file->move('uploads/setting/', $filename);
                $setting->logo = $filename;
            }

            if ($request->hasfile('website_favicon')) {
                $file = $request->file('website_favicon');
                $filename = uniqid() .'.'. $file->getClientOriginalExtension();
                $file->move('uploads/setting/', $filename);
                $setting->favicon = $filename;
            }

            $setting->description = $request->description;
            $setting->meta_title = $request->meta_title;
            $setting->meta_description = $request->meta_description;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->save();

            return redirect('admin/settings')->with('message', 'Settings Added!');
        }
    }
}
