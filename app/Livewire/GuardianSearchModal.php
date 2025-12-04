<?php

namespace App\Livewire;

use App\Models\Guardian;
use Livewire\Attributes\On;
use Livewire\Component;

class GuardianSearchModal extends Component
{
    public bool $open = false;
    public string $type = 'titular'; // titular | suplente
    public string $search = '';
    public $results = [];

    #[On('open-guardian-modal')]
    public function openModal(array $data = []): void
    {
        // Si no viene nada, por defecto 'titular'
        $this->type = $data['type'] ?? 'titular';
        $this->open = true;

        // Opcional, para limpiar búsqueda anterior
        $this->reset('search', 'results');
    }

    public function updatedSearch(): void
    {
        $term = trim($this->search);

        if ($term === '') {
            $this->results = [];
            return;
        }

        $this->results = Guardian::query()
            ->where('rut', 'like', "%{$term}%")
            ->orWhere('last_name_father', 'like', "%{$term}%")
            ->orWhere('first_name', 'like', "%{$term}%")
            ->limit(30)
            ->get();
    }

    public function selectGuardian(int $id): void
    {
        $this->dispatch('guardian-selected', [
            'id'   => $id,
            'type' => $this->type,
        ]);

        $this->open = false;
    }

    public function render()
    {
        return view('livewire.guardian-search-modal');
    }
}
