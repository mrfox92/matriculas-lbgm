<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        // Más adelante puedes agregar:
        // $this->middleware(['role:admin|digitador|visualizador']);
    }

    public function index()
    {
        // Livewire EnrollmentTable se encarga del listado/filtrado
        return view('enrollments.index');
    }

    public function create()
    {
        // Livewire EnrollmentForm se encarga de la matrícula de alumno nuevo
        return view('enrollments.create');
    }

    public function edit(Enrollment $enrollment)
    {
        // Cargamos relaciones para que el componente Livewire las tenga listas
        $enrollment->load([
            'student',
            'guardianTitular',
            'guardianSuplente',
            'course.gradeLevel',
        ]);

        return view('enrollments.edit', compact('enrollment'));
    }

    public function returning()
    {
        return view('enrollments.returning.index');
    }

    private function formatRut(?string $rut): ?string
    {
        if (!$rut) {
            return null;
        }

        // Limpiar todo excepto números y K
        $rut = preg_replace('/[^0-9kK]/', '', $rut);

        if (strlen($rut) < 2) {
            return $rut;
        }

        $dv  = substr($rut, -1);
        $num = substr($rut, 0, -1);

        return number_format((int) $num, 0, '', '.') . '-' . strtoupper($dv);
    }

    // SOLO PARA DESARROLLO / DEBUG
    public function pdf(Enrollment $enrollment)
    {
        $enrollment->load([
            'student',
            'guardianTitular',
            'guardianSuplente',
            'course.gradeLevel',
        ]);

        return view('pdf.enrollment', [
            'enrollment' => $enrollment,
            'student' => $enrollment->student,
            'guardianTitular' => $enrollment->guardianTitular,
            'guardianSuplente' => $enrollment->guardianSuplente,
            'formatRut' => fn ($rut) => $this->formatRut($rut),
        ]);
    }

    public function pdfView(Enrollment $enrollment)
    {
        $enrollment->load([
            'student',
            'guardianTitular',
            'guardianSuplente',
            'course.gradeLevel',
        ]);

        return Pdf::loadView('pdf.enrollment', [
            'enrollment' => $enrollment,
            'student' => $enrollment->student,
            'guardianTitular' => $enrollment->guardianTitular,
            'guardianSuplente' => $enrollment->guardianSuplente,
            'formatRut' => fn ($rut) => $this->formatRut($rut),
        ])
        ->setPaper('letter', 'portrait')
        ->stream('Ficha_Matricula.pdf');
    }

    public function pdfDownload(Enrollment $enrollment)
    {
        $enrollment->load([
            'student',
            'guardianTitular',
            'guardianSuplente',
            'course.gradeLevel',
        ]);

        $student = $enrollment->student;
        $course  = $enrollment->course;

        $studentName = Str::slug(
            "{$student->first_name} {$student->last_name_father} {$student->last_name_mother}",
            '_'
        );

        $courseName = Str::slug(
            trim(
                optional($course->gradeLevel)->name . ' ' .
                $course->letter . ' ' .
                $course->specialty
            ),
            '_'
        );

        $fileName = "Ficha_Matricula_{$studentName}_{$courseName}.pdf";

        return Pdf::loadView('pdf.enrollment', [
            'enrollment' => $enrollment,
            'student' => $student,
            'guardianTitular' => $enrollment->guardianTitular,
            'guardianSuplente' => $enrollment->guardianSuplente,
            'formatRut' => fn ($rut) => $this->formatRut($rut),
        ])
        ->setPaper('letter', 'portrait')
        ->download($fileName);
    }


}
