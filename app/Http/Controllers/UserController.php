<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        // Pencarian menggunakan LIKE yang kompatibel dengan SQLite & MySQL
        $users = User::when($keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(StoreRequest $request)
    {
        $dataReq = $request->validated();

        User::create([
            'name'     => $dataReq['name'],
            'email'    => $dataReq['email'],
            'password' => Hash::make($dataReq['password']),
            'role_id'  => $dataReq['role_id'],
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil dibuat');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $dataReq = $request->validated();

        $user->name    = $dataReq['name'];
        $user->email   = $dataReq['email'];
        $user->role_id = $dataReq['role_id'];

        if (!empty($dataReq['password'])) {
            $user->password = Hash::make($dataReq['password']);
        }

        $user->save();

        return redirect()->route('admin.users.edit', $user->id)->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }
}