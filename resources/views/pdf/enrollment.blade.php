{{-- resources/views/pdf/enrollment.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Matrícula {{ $enrollment->student->full_name }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 4px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        td,
        th {
            border: 1px solid #444;
            padding: 3px 5px;
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
    <div class="section-title">1. INDIVIDUALIZACIÓN DEL ALUMNO</div>

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
            <td><strong>Fecha nacimiento:</strong>
                {{ \Illuminate\Support\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>
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
        <tr>
            <td><strong>Alumno PIE:</strong> {{ $enrollment->is_pie_student ? 'SI' : 'NO' }}</td>
            <td colspan="2"><strong>Necesita almuerzo:</strong> {{ $enrollment->needs_lunch ? 'SI' : 'NO' }}</td>
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
    </table>


    {{-- ============================================================
         SECCIÓN 5: AUTORIZACIONES
         ============================================================ --}}
    <h3 style="margin-top: 10px;">AUTORIZACIONES</h3>

    <table width="100%" cellpadding="6" cellspacing="0" border="1">
        <tr>
            <td width="85%">
                Autorizo a mi hijo/a a participar en actividades extra-programáticas y
                extra-escolares dentro y fuera del establecimiento.
            </td>
            <td width="15%" align="center">
                {{ $enrollment->consent_extra_activities ? 'SI' : 'NO' }}
            </td>
        </tr>

        <tr>
            <td>
                Autorizo a mi hijo/a a ser fotografiado/a y/o grabado/a para fines
                pedagógicos e institucionales.
            </td>
            <td align="center">
                {{ $enrollment->consent_photos ? 'SI' : 'NO' }}
            </td>
        </tr>

        <tr>
            <td>
                Autorizo el traslado del estudiante en buses de acercamiento escolar.
            </td>
            <td align="center">
                {{ $enrollment->consent_school_bus ? 'SI' : 'NO' }}
            </td>
        </tr>

        <tr>
            <td>
                Autorizo el uso de recursos digitales e internet con fines educativos.
            </td>
            <td align="center">
                {{ $enrollment->consent_internet ? 'SI' : 'NO' }}
            </td>
        </tr>
    </table>

    {{-- ============================================================
         SECCIÓN 5: REGLAMENTO Y MANUAL DE CONVIVENCIA
         ============================================================ --}}

    <h3 style="margin-bottom: 10px;">
        REGLAMENTO Y CONVIVENCIA ESCOLAR
    </h3>

    <p>
        El/la apoderado/a declara haber leído y aceptado los reglamentos
        institucionales vigentes para el año escolar {{ $enrollment->school_year }}.
    </p>

    <table width="100%" cellspacing="0" cellpadding="6" border="1">
        <tr>
            <td width="70%">
                Reglamento Interno del Establecimiento
            </td>
            <td width="30%" align="center">
                <strong>
                    {{ $enrollment->accept_school_rules ? 'ACEPTADO' : 'NO ACEPTADO' }}
                </strong>
            </td>
        </tr>

        <tr>
            <td>
                Manual de Convivencia Escolar
                ({{ $enrollment->coexistence_manual_version ?? 'No informado' }})
            </td>
            <td align="center">
                <strong>
                    {{ $enrollment->accept_coexistence_rules ? 'ACEPTADO' : 'NO ACEPTADO' }}
                </strong>
            </td>
        </tr>

        <tr>
            <td>
                Términos y condiciones del proceso de matrícula
            </td>
            <td align="center">
                <strong>
                    {{ $enrollment->accept_terms_conditions ? 'ACEPTADO' : 'NO ACEPTADO' }}
                </strong>
            </td>
        </tr>
    </table>

    @if ($enrollment->accepted_at)
        <p style="margin-top: 10px;">
            Fecha de aceptación:
            <strong>{{ $enrollment->accepted_at->format('d/m/Y') }}</strong>
        </p>
    @endif



    {{-- ============================================================
         FIRMAS
         ============================================================ --}}
    <h3 style="margin-top: 10px;">OBSERVACIONES</h3>

    <table width="100%" border="1" cellspacing="0" cellpadding="0" style="page-break-inside: avoid;">
        <tr>
            <td style="
            height: 35px;
            padding: 6px;
            vertical-align: top;
        ">
                {{ $enrollment->notes ?? '' }}
            </td>
        </tr>
    </table>

    <h3 style="margin-top: 10px;">FIRMAS</h3>

    <table width="100%" cellpadding="0" cellspacing="0" style="page-break-inside: avoid;">
        <tr>
            <td width="50%" style="padding-right: 10px;">
                <table width="100%" border="1">
                    <tr>
                        <td
                            style="
                        height: 65px;
                        vertical-align: bottom;
                        text-align: center;
                        padding-bottom: 6px;
                        font-size: 11px;
                    ">
                            Nombre y firma del Apoderado(a)
                        </td>
                    </tr>
                </table>
            </td>

            <td width="50%" style="padding-left: 10px;">
                <table width="100%" border="1">
                    <tr>
                        <td
                            style="
                        height: 65px;
                        vertical-align: bottom;
                        text-align: center;
                        padding-bottom: 6px;
                        font-size: 11px;
                    ">
                            Nombre y firma Encargado(a) de Matrícula
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


</body>

</html>
