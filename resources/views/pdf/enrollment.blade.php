{{-- resources/views/pdf/enrollment.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matrícula {{ $enrollment->student->full_name }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 18px;
            margin-bottom: 6px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        td, th {
            border: 1px solid #444;
            padding: 4px 6px;
        }
        .no-border td {
            border: none !important;
        }
        .signature-box {
            border: 1px solid #000;
            height: 60px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    {{-- ENCABEZADO --}}
    <table class="no-border">
        <tr>
            <td style="width: 70%;">
                <strong>ESTABLECIMIENTO:</strong> Liceo Bicentenario Gabriela Mistral<br>
                <strong>COMUNA:</strong> Máfil<br>
                <strong>AÑO MATRÍCULA:</strong> {{ $enrollment->school_year }}
            </td>
            <td style="text-align: right;">
                <strong>FICHA DE MATRÍCULA</strong><br>
                Estudiante Nº: {{ $enrollment->id }}
            </td>
        </tr>
    </table>


    {{-- ============================================================
         SECCIÓN 1: DATOS DEL ESTUDIANTE
         ============================================================ --}}
    <div class="section-title">1. DATOS DEL ESTUDIANTE</div>

    <table>
        <tr>
            <td><strong>RUT:</strong> {{ $student->rut }}</td>
            <td colspan="2"><strong>Nombres:</strong> {{ $student->first_name }}</td>
        </tr>
        <tr>
            <td><strong>Apellido paterno:</strong> {{ $student->last_name_father }}</td>
            <td><strong>Apellido materno:</strong> {{ $student->last_name_mother }}</td>
            <td><strong>Género:</strong> {{ $student->gender }}</td>
        </tr>
        <tr>
            <td><strong>Fecha nacimiento:</strong> {{ $student->birth_date }}</td>
            <td><strong>Nacionalidad:</strong> {{ $student->nationality }}</td>
            <td><strong>Religión:</strong> {{ $student->religion }}</td>
        </tr>

        @if ($student->religion === 'Otra')
        <tr>
            <td colspan="3"><strong>Especificar religión:</strong> {{ $student->religion_other }}</td>
        </tr>
        @endif

        <tr>
            <td><strong>Pueblo originario:</strong> {{ $student->indigenous_ancestry ? 'Sí' : 'No' }}</td>
            <td colspan="2"><strong>Detalle:</strong> {{ $student->indigenous_ancestry_type }}</td>
        </tr>

        <tr>
            <td colspan="2"><strong>Dirección:</strong> {{ $student->address }}</td>
            <td><strong>Comuna:</strong> {{ $student->commune }}</td>
        </tr>

        <tr>
            <td><strong>Teléfono:</strong> {{ $student->phone }}</td>
            <td colspan="2"><strong>Teléfono emergencia:</strong> {{ $student->emergency_phone }}</td>
        </tr>

        <tr>
            <td><strong>Problemas de salud:</strong> {{ $student->has_health_issues ? 'Sí' : 'No' }}</td>
            <td colspan="2"><strong>Detalle:</strong> {{ $student->health_issues_details }}</td>
        </tr>
    </table>



    {{-- ============================================================
         SECCIÓN 2: DATOS DEL APODERADO
         ============================================================ --}}
    <div class="section-title">2. DATOS DEL APODERADO TITULAR</div>

    <table>
        <tr>
            <td><strong>Nombre completo:</strong> {{ $guardianTitular->full_name }}</td>
            <td><strong>RUT:</strong> {{ $guardianTitular->rut }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Dirección:</strong> {{ $guardianTitular->address }}</td>
        </tr>
        <tr>
            <td><strong>Comuna:</strong> {{ $guardianTitular->commune }}</td>
            <td><strong>Teléfono:</strong> {{ $guardianTitular->phone }}</td>
        </tr>
        <tr>
            <td><strong>Nivel educacional:</strong> {{ $guardianTitular->education_level }}</td>
            <td><strong>Ocupación:</strong> {{ $guardianTitular->employment_status }}</td>
        </tr>
    </table>

    @if ($guardianSuplente)
        <div class="section-title">3. APODERADO SUPLENTE</div>

        <table>
            <tr>
                <td><strong>Nombre completo:</strong> {{ $guardianSuplente->full_name }}</td>
                <td><strong>RUT:</strong> {{ $guardianSuplente->rut }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Dirección:</strong> {{ $guardianSuplente->address }}</td>
            </tr>
            <tr>
                <td><strong>Comuna:</strong> {{ $guardianSuplente->commune }}</td>
                <td><strong>Teléfono:</strong> {{ $guardianSuplente->phone }}</td>
            </tr>
        </table>
    @endif



    {{-- ============================================================
         SECCIÓN 4: MATRÍCULA
         ============================================================ --}}
    <div class="section-title">4. DATOS DE MATRÍCULA</div>

    <table>
        <tr>
            <td><strong>Año escolar:</strong> {{ $enrollment->school_year }}</td>
            <td>
                <strong>Curso:</strong>
                {{ optional($enrollment->course->gradeLevel)->name }}
                {{ $enrollment->course->letter }}
                {{ $enrollment->course->specialty }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>¿Con quién vive?</strong> {{ $enrollment->lives_with }}
            </td>
        </tr>
        <tr>
            <td><strong>Alumno PIE:</strong> {{ $enrollment->is_pie_student ? 'Sí' : 'No' }}</td>
            <td><strong>Necesita almuerzo:</strong> {{ $enrollment->needs_lunch ? 'Sí' : 'No' }}</td>
        </tr>
    </table>


    {{-- ============================================================
         SECCIÓN 5: AUTORIZACIONES
         ============================================================ --}}
    <div class="section-title">5. AUTORIZACIONES</div>

    <table>
        <tr>
            <td><strong>Actividades extraescolares:</strong> {{ $enrollment->consent_extra_activities ? 'Sí' : 'No' }}</td>
        </tr>
        <tr>
            <td><strong>Fotografías pedagógicas:</strong> {{ $enrollment->consent_photos ? 'Sí' : 'No' }}</td>
        </tr>
        <tr>
            <td><strong>Bus de acercamiento:</strong> {{ $enrollment->consent_school_bus ? 'Sí' : 'No' }}</td>
        </tr>
        <tr>
            <td><strong>Uso de internet:</strong> {{ $enrollment->consent_internet ? 'Sí' : 'No' }}</td>
        </tr>
    </table>


    {{-- ============================================================
         FIRMAS
         ============================================================ --}}
    <div class="section-title">6. FIRMAS</div>

    <table class="no-border">
        <tr>
            <td style="width: 33%; text-align:center;">
                <div class="signature-box"></div>
                Apoderado titular
            </td>
            <td style="width: 33%; text-align:center;">
                <div class="signature-box"></div>
                Apoderado suplente
            </td>
            <td style="width: 33%; text-align:center;">
                <div class="signature-box"></div>
                Dirección / Inspectoría
            </td>
        </tr>
    </table>

</body>
</html>
