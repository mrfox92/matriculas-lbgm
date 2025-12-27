<?php
namespace App\Exports;

use App\Models\Enrollment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnrollmentsExport implements FromCollection, WithHeadings
{
    public function __construct(private array $filters = [])
    {
    }

    public function headings(): array
    {
        return [
            'ID',
            'Estudiante',
            'RUT',
            'Curso',
            'Apoderado titular',
            'Tipo alumno',
            'Estado matrícula',
        ];
    }

    public function collection(): Collection
    {
        return Enrollment::query()
            ->with(['student', 'course', 'guardianTitular'])
            ->year(2026)
            ->applyFilters($this->filters)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($e) {

                return [
                    $e->id,

                    // Estudiante
                    $e->student->full_name,

                    // RUT
                    $e->student->rut,

                    // Curso
                    $e->course?->full_name ?? '—',

                    // Apoderado titular
                    $e->guardianTitular
                    ? $e->guardianTitular->full_name
                    : 'No informado',

                    // Tipo alumno (igual que la tabla)
                    $e->enrollment_type === 'New Student'
                    ? 'Nuevo'
                    : 'Antiguo',

                    // Estado matrícula (traducido)
                    match ($e->status) {
                        'Confirmed' => 'Confirmada',
                        'Pending' => 'Pendiente',
                        'Cancelled' => 'Anulada',
                        default => $e->status,
                    },
                ];
            });
    }
}

