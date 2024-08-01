<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard() {
        // Obtener ingresos (facturas)
        $startDate = Carbon::now()->subDays(7)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $ingresos = collect(DB::table('facturas')
            ->select(DB::raw('DATE(fecha) as fecha'), DB::raw('SUM(total_factura) as total_ingresos'))
            ->whereBetween('fecha', [$startDate, $endDate])
            ->groupBy('fecha')
            ->get());

        // Obtener egresos (compras)
        $egresos = collect(DB::table('compras')
            ->select(DB::raw('DATE(fecha) as fecha'), DB::raw('SUM(total_compra) as total_egresos'))
            ->whereBetween('fecha', [$startDate, $endDate])
            ->groupBy('fecha')
            ->get());

        // Obtener las fechas únicas y ordenarlas
        $dates = $ingresos->pluck('fecha')->merge($egresos->pluck('fecha'))->unique()->sort()->values();

        // Generar datos de ingresos y egresos para el gráfico
        $ingresosData = $dates->map(function ($date) use ($ingresos) {
            return $ingresos->firstWhere('fecha', $date)->total_ingresos ?? 0;
        });

        $egresosData = $dates->map(function ($date) use ($egresos) {
            return $egresos->firstWhere('fecha', $date)->total_egresos ?? 0;
        });

        // Obtener vistas de páginas
        $pageViews = DB::table('page_views')
            ->select('page_url', DB::raw('SUM(views) as views'))
            ->groupBy('page_url')
            ->get();

        return view('admin.dashboard', [
            'dates' => $dates,
            'ingresos' => $ingresos,
            'egresos' => $egresos,
            'ingresosData' => $ingresosData,
            'egresosData' => $egresosData,
            'pageViews' => $pageViews,
        ]);
    }

    public function login() {
        return view('admin.auth.login');
    }
}
