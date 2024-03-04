<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request) {
        $user = User::find($request->id);

        $user->role_as = $request->role_as;
        $user->update();

        return redirect('admin/users')->with('message', 'Role Updated Successfully');

    }

    public function destroy(Request $request) {
        $user = User::find($request->user_id);

        if ($user) {
             
            $user->delete();

            return redirect('admin/users')->with('message', 'User Deleted Successfully');
        } else {
            return redirect('admin/users')->with('message', 'No User Found');
        }
    }
}
