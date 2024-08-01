<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promociones';
    protected $primaryKey = 'id_promocion';
    protected $fillable = [
        'id_producto',
        'nombre',
        'descripcion',
        'descuento',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime:Y-m-d',
        'fecha_fin' => 'datetime:Y-m-d',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
