<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;

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
        ]);
    }

}
