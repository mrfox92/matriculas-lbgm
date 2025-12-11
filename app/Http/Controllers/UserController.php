<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::with('roles')->orderBy('name')->paginate(2),
            'roles' => Role::pluck('name'),
        ]);
    }

    public function createDigitador()
    {
        return view('users.create-digitador');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
}
