<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha Matrícula {{ $student->full_name }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: middle;
        }

        .no-border td {
            border: none !important;
            padding: 0;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 4px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }

        .small {
            font-size: 10px;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- ================= ENCABEZADO ================= --}}
    <table class="no-border">
        <tr>
            <td style="width:15%; text-align:left;">
                <img src="{{ public_path('images/logo-lbgm.png') }}" style="height:55px;">
            </td>

            <td style="width:55%; text-align:left;">
                <strong>LICEO BICENTENARIO GABRIELA MISTRAL</strong><br>
                Dirección: B. O’Higgins 306<br>
                Comuna: Máfil
            </td>

            <td style="width:30%; text-align:right;">
                <strong>FORMULARIO MATRÍCULA</strong><br>
                Año: {{ $enrollment->school_year }}<br>
                Curso:
                {{ optional($enrollment->course->gradeLevel)->name }}
                {{ $enrollment->course->letter }}
                {{ $enrollment->course->specialty }}<br>
                Fecha: {{ now()->format('d/m/Y') }}
            </td>
        </tr>
    </table>

    {{-- ================= 1. ESTUDIANTE ================= --}}
    <div class="section-title">1. INDIVIDUALIZACIÓN DEL ALUMNO</div>

    <table>
        <tr>
            <td><strong>RUT:</strong> {{ $formatRut($student->rut) }}</td>
            <td colspan="2"><strong>Nombres:</strong> {{ $student->first_name }}</td>
        </tr>
        <tr>
            <td><strong>Apellido paterno:</strong> {{ $student->last_name_father }}</td>
            <td><strong>Apellido materno:</strong> {{ $student->last_name_mother }}</td>
            <td><strong>Género:</strong> {{ $student->gender }}</td>
        </tr>
        <tr>
            <td><strong>Fecha nacimiento:</strong> {{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}
            </td>
            <td><strong>Nacionalidad:</strong> {{ $student->nationality }}</td>
            <td><strong>Religión:</strong> {{ $student->religion }}</td>
        </tr>
        <tr>
            <td><strong>Pueblo originario:</strong> {{ $student->indigenous_ancestry ? 'SI' : 'NO' }}</td>
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
            <td><strong>Problemas de salud:</strong> {{ $student->has_health_issues ? 'SI' : 'NO' }}</td>
            <td colspan="2"><strong>Detalle:</strong> {{ $student->health_issues_details }}</td>
        </tr>
        <tr>
            <td><strong>Alumno PIE:</strong> {{ $enrollment->is_pie_student ? 'SI' : 'NO' }}</td>
            <td colspan="2"><strong>Necesita almuerzo:</strong> {{ $enrollment->needs_lunch ? 'SI' : 'NO' }}</td>
        </tr>
    </table>

    {{-- ============================= --}}
    {{-- 2. DATOS DEL APODERADO TITULAR --}}
    {{-- ============================= --}}

    <h3 class="section-title">2. DATOS DEL APODERADO TITULAR</h3>

    <table class="table">
        <tr>
            <td colspan="4">
                <strong>Parentesco con el estudiante:</strong>
                {{ $enrollment->guardian_relationship ?? 'No informado' }}
                @if ($enrollment->guardian_relationship === 'Otro')
                    ({{ $enrollment->guardian_relationship_other }})
                @endif
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <strong>Nombre completo:</strong>
                {{ $guardianTitular?->full_name ?? 'No informado' }}
            </td>

            <td>
                <strong>RUT:</strong>
                {{ $guardianTitular?->rut ? $formatRut($guardianTitular->rut) : 'No informado' }}
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <strong>Dirección:</strong>
                {{ $guardianTitular?->address ?? 'No informado' }}
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <strong>Comuna:</strong>
                {{ $guardianTitular?->commune ?? 'No informado' }}
            </td>

            <td>
                <strong>Teléfono:</strong>
                {{ $guardianTitular?->phone ?? 'No informado' }}
            </td>

            <td>
                <strong>Sexo:</strong>
                {{ $guardianTitular?->gender ?? 'No informado' }}
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <strong>Teléfono de emergencia:</strong>
                {{ $guardianTitular?->emergency_phone ?? 'No informado' }}
            </td>

            <td colspan="2">
                <strong>Nivel educacional:</strong>
                {{ $guardianTitular?->education_level ?? 'No informado' }}
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <strong>¿Con quién vive el estudiante?:</strong>
                {{ $enrollment->lives_with ?? 'No informado' }}
            </td>
        </tr>
    </table>


    {{-- ================= 3. APODERADO SUPLENTE ================= --}}
    @if ($guardianSuplente)
        <div class="section-title">3. APODERADO SUPLENTE</div>

        <table>
            <tr>
                <td><strong>Nombre:</strong> {{ $guardianSuplente->full_name }}</td>
                <td><strong>RUT:</strong> {{ $formatRut($guardianSuplente->rut) }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Teléfono:</strong> {{ $guardianSuplente->phone }}</td>
            </tr>
        </table>
    @endif

    {{-- ================= AUTORIZACIONES ================= --}}
    <div class="section-title">AUTORIZACIONES</div>

    <table>
        <tr>
            <td>Actividades extra-programáticas</td>
            <td class="center">{{ $enrollment->consent_extra_activities ? 'SI' : 'NO' }}</td>
        </tr>
        <tr>
            <td>Uso de imagen</td>
            <td class="center">{{ $enrollment->consent_photos ? 'SI' : 'NO' }}</td>
        </tr>
        <tr>
            <td>Traslado escolar</td>
            <td class="center">{{ $enrollment->consent_school_bus ? 'SI' : 'NO' }}</td>
        </tr>
        <tr>
            <td>Uso de recursos digitales</td>
            <td class="center">{{ $enrollment->consent_internet ? 'SI' : 'NO' }}</td>
        </tr>
    </table>

    {{-- ================= REGLAMENTO ================= --}}
    <div class="section-title">REGLAMENTO Y CONVIVENCIA ESCOLAR</div>

    <table>
        <tr>
            <td>Reglamento de Evaluación del Establecimiento</td>
            <td class="center">ACEPTADO</td>
        </tr>
        <tr>
            <td>Manual de Convivencia Escolar vigente</td>
            <td class="center">ACEPTADO</td>
        </tr>
        <tr>
            <td>Términos y condiciones del proceso de matrícula</td>
            <td class="center">ACEPTADO</td>
        </tr>
    </table>


    <p><strong>Fecha de aceptación:</strong> {{ $enrollment->accepted_at?->format('d/m/Y') }}</p>

    {{-- ================= FIRMAS ================= --}}
    <table class="no-border" style="margin-top:15px;">
        <tr>
            <td style="width:50%; border:1px solid #000; height:60px;" class="center">
                Nombre y firma del Apoderado(a)
            </td>
            <td style="width:50%; border:1px solid #000; height:60px;" class="center">
                Nombre y firma Encargado(a) de Matrícula
            </td>
        </tr>
    </table>

</body>

</html>
