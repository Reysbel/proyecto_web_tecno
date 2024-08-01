@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Gráfico de Ingresos y Egresos (Últimos 7 Días)</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Estadísticas de Ingresos y Egresos (Últimos 7 Días)</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Ingresos</th>
                                    <th>Egresos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $ingresosByDate = $ingresos->keyBy('fecha');
                                    $egresosByDate = $egresos->keyBy('fecha');
                                @endphp
                                
                                @foreach($dates as $date)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}</td>
                                        <td>{{ number_format($ingresosByDate->get($date)->total_ingresos ?? 0, 2) }}</td>
                                        <td>{{ number_format($egresosByDate->get($date)->total_egresos ?? 0, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Estadísticas de Vistas de Páginas</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>URL de Página</th>
                                    <th>Vistas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pageViews as $pageView)
                                    <tr>
                                        <td>{{ $pageView->page_url }}</td>
                                        <td>{{ $pageView->views }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dates),
            datasets: [
                {
                    label: 'Ingresos',
                    data: @json($ingresosData),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Egresos',
                    data: @json($egresosData),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
