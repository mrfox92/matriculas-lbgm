<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ← IMPORTANTE

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);  
        // Si luego agregas roles con Spatie:
        // $this->middleware(['role:admin|digitador|visualizador']);
    }

    public function index()
    {
        return view('enrollments.index');
    }

    public function create()
    {
        return view('enrollments.create');
    }

    public function edit(Enrollment $enrollment)
    {
        return view('enrollments.edit', compact('enrollment'));
    }

    public function pdf(Enrollment $enrollment)
    {
        return "Aquí irá la generación del PDF de matrícula para ID {$enrollment->id}";
    }
}
