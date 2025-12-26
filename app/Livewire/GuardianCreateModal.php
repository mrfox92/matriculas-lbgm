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
    public $gender;
    public $birth_date;

    public $address;
    public $commune;
    public $phone;
    public $emergency_phone;

    public $education_level;
    public $employment_status;
    public $work_main_place;
    public $workplace;

    #[On('open-guardian-create')]
    public function openCreate($type = 'titular')
    {
        $this->reset();
        $this->type = $type;
        $this->open = true;
    }

    public function save()
    {
        $guardian = Guardian::create([
            'rut' => $this->rut,
            'first_name' => $this->first_name,
            'last_name_father' => $this->last_name_father,
            'last_name_mother' => $this->last_name_mother,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,

            'address' => $this->address,
            'commune' => $this->commune,
            'phone' => $this->phone,
            'emergency_phone' => $this->emergency_phone,

            'education_level' => $this->education_level,
            'employment_status' => $this->employment_status,
            'work_main_place' => $this->work_main_place,
            'workplace' => $this->workplace,
        ]);

        $this->dispatch(
            'guardian-selected',
            guardian_id: $guardian->id,
            type: $this->type
        );

        $this->dispatch('close-guardian-modal'); // NUEVO
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.guardian-create-modal');
    }
}

