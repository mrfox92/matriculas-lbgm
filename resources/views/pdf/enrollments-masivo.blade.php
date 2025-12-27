<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Matrículas 2026</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        h1 {
            font-size: 14px;
            margin-bottom: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3f4f6;
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            padding: 4px;
            vertical-align: top;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            display: inline-block;
        }

        .nuevo { background: #dbeafe; }
        .antiguo { background: #e5e7eb; }

        .confirmada { background: #dcfce7; }
        .pendiente { background: #fef3c7; }
        .anulada { background: #fee2e2; }

        .muted {
            color: #6b7280;
            font-style: italic;
        }
    </style>
</head>
<body>

    <h1>Panel de Matrículas 2026</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Estudiante</th>
                <th>RUT</th>
                <th>Curso</th>
                <th>Apoderado titular</th>
                <th>Tipo alumno</th>
                <th>Estado matrícula</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $e)
                <tr>
                    <td>{{ $e->id }}</td>

                    <td>{{ $e->student->full_name }}</td>

                    <td>{{ $e->student->rut }}</td>

                    <td>{{ $e->course?->full_name ?? '—' }}</td>

                    <td>
                        {{ $e->guardianTitular
                            ? $e->guardianTitular->full_name
                            : 'No informado' }}
                    </td>

                    <td>
                        <span class="badge {{ $e->enrollment_type === 'New Student' ? 'nuevo' : 'antiguo' }}">
                            {{ $e->enrollment_type === 'New Student' ? 'Nuevo' : 'Antiguo' }}
                        </span>
                    </td>

                    <td>
                        <span class="badge
                            {{ strtolower(match ($e->status) {
                                'Confirmed' => 'confirmada',
                                'Pending' => 'pendiente',
                                'Cancelled' => 'anulada',
                                default => 'pendiente'
                            }) }}">
                            {{ match ($e->status) {
                                'Confirmed' => 'Confirmada',
                                'Pending' => 'Pendiente',
                                'Cancelled' => 'Anulada',
                                default => $e->status
                            } }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
