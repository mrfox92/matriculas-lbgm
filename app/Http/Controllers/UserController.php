<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // return view('users.index', [
        //     'users' => User::with('roles')->orderBy('name')->paginate(5),
        //     'roles' => Role::pluck('name'),
        // ]);
        return view('users.index');
    }
    public function create()
    {
        return view('users.create');
    }

    public function toggle(User $user)
    {
        // Evitar que se desactive a sí mismo
        if (auth()->id() === $user->id) {
            return back()->with('status', 'No puedes desactivar tu propio usuario.');
        }

        $user->update([
            'active' => !$user->active,
        ]);

        return back()->with('status', 'Estado del usuario actualizado.');
    }


    public function createDigitador()
    {
        return view('users.create-digitador');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        // Nunca eliminarse a sí mismo
        if (auth()->id() === $user->id) {
            return back()->with('status', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete(); // Soft delete

        return back()->with('status', 'Usuario eliminado correctamente.');
    }

}
