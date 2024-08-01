<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEgreso extends Model
{
    use HasFactory;

    protected $table = 'detalle_egresos';

    protected $fillable = [
        'total_egreso',
        'fecha',
        'id_compra',
        'id_reporte'
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'id_reporte');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }
}
