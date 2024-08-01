<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    use HasFactory;

    protected $table = 'detalle_ingresos';

    protected $fillable = [
        'total_ingreso',
        'fecha',
        'id_factura',
        'id_reporte'
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'id_reporte');
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }
}
