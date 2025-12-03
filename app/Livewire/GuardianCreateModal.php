<?php

namespace App\Livewire;

use App\Models\Guardian;
use Livewire\Attributes\On;
use Livewire\Component;

class GuardianCreateModal extends Component
{
    public $open = false;
    public $type = 'titular';

    public $rut;
    public $first_name;
    public $last_name_father;
    public $last_name_mother;

    #[On('open-guardian-create')]
    public function openCreate()
    {
        $this->reset(['rut','first_name','last_name_father','last_name_mother']);
        $this->open = true;
    }

    public function save()
    {
        $g = Guardian::create([
            'rut' => $this->rut,
            'first_name' => $this->first_name,
            'last_name_father' => $this->last_name_father,
            'last_name_mother' => $this->last_name_mother,
        ]);

        $this->dispatch('guardian-selected', [
            'id' => $g->id,
            'type' => $this->type
        ]);

        $this->open = false;
    }

    public function render()
    {
        return view('livewire.guardian-create-modal');
    }
}
