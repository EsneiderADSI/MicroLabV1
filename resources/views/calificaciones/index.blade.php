@extends('layout')

@section('title', 'Calificaciones MicroLab')

@section('content')
<div class="container mt-4">
    <h1>Calificaciones <a href="/modulos">MicroLab</a></h1>
    <table id="calificaciones-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>No. Documento</th>
                <th>Fecha y Hora</th>
                <th>Práctica 1</th>
                <th>Práctica 2</th>
                <th>Práctica 3</th>
                <th>Práctica 4</th>
                <th>Ponderado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calificaciones as $calificacion)
                <tr>
                    <td>{{ $calificacion->estudiante->nombres }} {{ $calificacion->estudiante->apellidos }}</td>
                    <td>{{ $calificacion->estudiante->numero_identificacion }}</td>
                    <td data-fecha="{{ $calificacion->fecha_hora }}">{{ $calificacion->fecha_hora }}</td>
                    <td>{{ number_format($calificacion->practica1, 1) }}</td>
                    <td>{{ number_format($calificacion->practica2, 1) }}</td>
                    <td>{{ number_format($calificacion->practica3, 1) }}</td>
                    <td>{{ number_format($calificacion->practica4, 1) }}</td>
                    <td>
                        @php
                            $ponderado = ($calificacion->practica1 + $calificacion->practica2 + $calificacion->practica3 + $calificacion->practica4) / 4;
                        @endphp
                        {{ number_format($ponderado, 1) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Configuración de Moment.js al español
        moment.locale('es');

        // Formatear fechas en la tabla
        $('#calificaciones-table tbody tr').each(function () {
            var fechaOriginal = $(this).find('td[data-fecha]').data('fecha');
            if (fechaOriginal) {
                var fechaFormateada = moment(fechaOriginal).format('DD [de] MMMM [de] YYYY, h:mm A');
                $(this).find('td[data-fecha]').text(fechaFormateada);
            }
        });

        // Inicializar DataTables
        $('#calificaciones-table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
</script>
@endsection
