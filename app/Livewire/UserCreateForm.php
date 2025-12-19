<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserCreateForm extends Component
{
    public string $name = '';
    public string $rut = '';
    public string $email = '';
    public bool   $active = true;
    public string $role = '';

    public array $roles = [];

    public function mount(): void
    {
        $this->roles = Role::pluck('name')->toArray();
    }

    protected function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'rut'   => ['required', 'string', 'max:20', 'unique:users,rut'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role'  => ['required'],
            'active'=> ['boolean'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $user = User::create([
            'name'     => $this->name,
            'rut'      => $this->rut, // mutator normaliza
            'email'    => $this->email,
            'active'   => $this->active,
            'password' => Hash::make(
                config('app.matriculas_default_password', 'matriculalbgm2026')
            ),
        ]);

        $user->syncRoles([$this->role]);

        Session::flash('status', 'Usuario creado correctamente.');

        redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.user-create-form');
    }
}
