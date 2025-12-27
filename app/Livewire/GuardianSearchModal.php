<?php

namespace App\Livewire;

use App\Models\Guardian;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Collection;

class GuardianSearchModal extends Component
{
    public bool $open = false;
    public string $type = 'titular'; // CONTEXTO
    public string $search = '';
    public Collection $results;

    public function mount(): void
    {
        $this->results = collect();
    }

    #[On('open-guardian-modal')]
    public function openModal(string $type = 'titular'): void
    {
        $this->type = in_array($type, ['titular', 'suplente'], true)
            ? $type
            : 'titular';

        $this->search = '';
        $this->results = collect(); // ✅ SIEMPRE Collection
        $this->open = true;
    }



    #[On('close-guardian-modal')]
    #[On('close-guardian-search-modal')]
    public function closeModal(): void
    {
        $this->open = false;
        $this->reset('search');
        $this->results = collect();
    }

    public function searchGuardians(): void
    {
        $value = trim($this->search);

        if (strlen($value) < 2) {
            $this->results = collect();
            return;
        }

        $this->results = Guardian::query()
            ->where('rut', 'like', "%{$value}%")
            ->orWhere('first_name', 'like', "%{$value}%")
            ->orWhere('last_name_father', 'like', "%{$value}%")
            ->orWhere('last_name_mother', 'like', "%{$value}%")
            ->orderBy('last_name_father')
            ->limit(15)
            ->get();
    }

    public function selectGuardian(int $id): void
    {
        // ✅ Livewire 3: enviar parámetros nombrados
        $this->dispatch(
            'guardian-selected',
            guardian_id: $id,
            type: $this->type
        );

        $this->reset('search');
        $this->results = collect();
        $this->open = false;
    }


    public function render()
    {
        return view('livewire.guardian-search-modal');
    }
}
