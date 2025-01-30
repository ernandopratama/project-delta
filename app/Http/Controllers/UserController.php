<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {
        $title = 'User';
        $perPage = $request->per_page ?? 10;
        $search = $request->search ?? '';
        // Paginate data
        $get = User::where(function($query) use ($search) {
            $query->orWhere('name', 'like', "%$search%");
            $query->orWhere('email', 'like', "%$search%");
        })->paginate($perPage);

        // Roles
        $roles = Role::all();

        return view('web.user', compact('get', 'roles', 'title'));
    }

    public function show($id) {
        $get = User::find($id);
        return response()->json($get);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::create($validated);
        session()->flash('success', 'User created successfully');
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        // $validated['password'] = bcrypt($validated['password']);

        User::find($id)->update($validated);
        session()->flash('success', 'User updated successfully');
        return redirect()->back();
    }

    public function delete($id) {
        User::find($id)->delete();
        session()->flash('success', 'User deleted successfully');
        return redirect()->back();
    }
}
