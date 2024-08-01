<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'nombre',
        'autor',
        'editorial',
        'breve_descripcion',
        'descripcion',
        'precio_compra',
        'precio',
        'imagen',
        'descuento',
        'total_venta',
        'stock',
        'estado',
        'id_categoria'
    ];

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
}

