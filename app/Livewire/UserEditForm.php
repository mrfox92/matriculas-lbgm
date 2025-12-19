<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserEditForm extends Component
{
    public User $user;

    public string $name = '';
    public string $rut = '';
    public string $email = '';
    public bool $active = true;
    public string $role = '';

    // Para password
    public string $newPassword = '';
    public bool $resetPassword = false;

    public array $roles = [];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->rut = $user->rut;
        $this->email = $user->email;
        $this->active = $user->active;
        $this->role = $user->roles->pluck('name')->first() ?? '';

        $this->roles = Role::pluck('name')->toArray();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'rut' => ['required', 'string', 'max:20', 'unique:users,rut,' . $this->user->id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'role' => ['required'],
            'active' => ['boolean'],

            // password opcional
            'newPassword' => [
                'nullable',
                'string',
                'min:8',
                'regex:/[a-z]/', // al menos una letra
                'regex:/[0-9]/', // al menos un número
            ],

        ];
    }

    protected function messages(): array
    {
        return [
            'newPassword.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'newPassword.regex' => 'La contraseña debe contener letras y números.',
        ];
    }

    public function update(): void
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'rut' => $this->rut,
            'email' => $this->email,
            'active' => $this->active,
        ]);

        $this->user->syncRoles([$this->role]);

        // Reset o cambio de contraseña
        if ($this->resetPassword) {
            $this->user->password = Hash::make(
                config('app.matriculas_default_password', 'matriculalbgm2026')
            );
            $this->user->save();
        }

        if ($this->newPassword !== '') {
            $this->user->password = Hash::make($this->newPassword);
            $this->user->save();
        }

        Session::flash('status', 'Usuario actualizado correctamente.');

        redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.user-edit-form');
    }
}
