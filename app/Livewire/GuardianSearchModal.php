<?php

namespace App\Livewire;

use App\Models\Guardian;
use Livewire\Attributes\On;
use Livewire\Component;

class GuardianSearchModal extends Component
{
    public $open = false;
    public $type = 'titular'; // titular | suplente
    public $search = '';
    public $results = [];

    #[On('open-guardian-modal')]
    public function openModal($data)
    {
        $this->type = $data['type'];
        $this->open = true;
    }

    public function updatedSearch()
    {
        $this->results = Guardian::where('rut', 'like', "%{$this->search}%")
            ->orWhere('last_name_father', 'like', "%{$this->search}%")
            ->orWhere('first_name', 'like', "%{$this->search}%")
            ->limit(30)
            ->get();
    }

    public function selectGuardian($id)
    {
        $this->dispatch('guardian-selected', [
            'id' => $id,
            'type' => $this->type
        ]);

        $this->open = false;
    }

    public function render()
    {
        return view('livewire.guardian-search-modal');
    }
}
