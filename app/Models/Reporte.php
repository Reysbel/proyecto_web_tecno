<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';
    protected $primaryKey = 'id_reporte';

    protected $fillable = [
        'fecha',
        'total_caja',
        'ingreso',
        'egreso',
        'user_id'
    ];

    public function detalleIngresos()
    {
        return $this->hasMany(DetalleIngreso::class, 'id_reporte');
    }

    public function detalleEgresos()
    {
        return $this->hasMany(DetalleEgreso::class, 'id_reporte');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
