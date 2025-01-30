<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request) {
        $title = 'Role';
        $perPage = $request->per_page ?? 10;
        $search = $request->search ?? '';
        // Paginate data
        $get = Role::where(function($query) use ($search) {
            $query->orWhere('name', 'like', "%$search%");
            $query->orWhere('description', 'like', "%$search%");
        })->paginate($perPage);

        return view('web.role', compact('get', 'title'));
    }

    public function show($id) {
        $get = Role::find($id);
        return response()->json($get);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Role::create($validated);
        session()->flash('success', 'Role created successfully');
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Role::find($id)->update($validated);
        session()->flash('success', 'Role updated successfully');
        return redirect()->back();
    }

    public function delete($id) {
        Role::find($id)->delete();
        session()->flash('success', 'Role deleted successfully');
        return redirect()->back();
    }
}
