<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PanelPdfController extends Controller
{
    public function enrollments(Request $request)
    {
        $filters = $request->only([
            'courseId',
            'status',
            'enrollmentType',
            'level',
        ]);

        $enrollments = Enrollment::query()
            ->with(['student', 'course', 'guardianTitular'])
            ->year(2026)
            ->applyFilters($filters)
            ->orderBy('id', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.enrollments-masivo', [
            'enrollments' => $enrollments,
            'filters'     => $filters,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('matriculas_2026.pdf');
    }
}
