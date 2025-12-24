<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public string $search = '';
    public string $role = '';
    public string $status = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'role'   => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query()
            ->with('roles')
            ->orderBy('name');

        // Buscar (nombre / rut / email)
        if (strlen(trim($this->search)) >= 2) {
            $term = $this->search;

            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('rut', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%");
            });
        }

        // Rol
        if ($this->role !== '') {
            $query->whereHas('roles', fn ($q) =>
                $q->where('name', $this->role)
            );
        }

        // Estado
        if ($this->status !== '') {
            $query->where('active', $this->status === 'active');
        }

        return view('livewire.user-table', [
            'users' => $query->paginate(10),
            'roles' => Role::pluck('name'),
        ]);
    }
}
