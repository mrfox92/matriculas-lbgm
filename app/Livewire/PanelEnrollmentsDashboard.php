<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Enrollment;

class PanelEnrollmentsDashboard extends Component
{
    private const SCHOOL_YEAR = 2026;

    public int $total = 0;
    public int $newCount = 0;
    public int $returningCount = 0;
    public int $pendingCount = 0;
    public int $confirmedCount = 0;
    public int $cancelledCount = 0;

    public function mount(): void
    {
        $this->loadStats();
    }

    private function loadStats(): void
    {
        $base = Enrollment::query()
            ->where('school_year', self::SCHOOL_YEAR);

        $this->total = (clone $base)->count();

        $this->newCount = (clone $base)
            ->where('enrollment_type', 'New Student')
            ->count();

        $this->returningCount = (clone $base)
            ->where('enrollment_type', 'Returning Student')
            ->count();

        $this->pendingCount = (clone $base)
            ->where('status', 'Pending')
            ->count();

        $this->confirmedCount = (clone $base)
            ->where('status', 'Confirmed')
            ->count();

        $this->cancelledCount = (clone $base)
            ->where('status', 'Cancelled')
            ->count();
    }

    public function render()
    {
        return view('livewire.panel-enrollments-dashboard');
    }
}
