<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'id_compra';

    protected $fillable = [
        'nit_recibo',
        'fecha',
        'total_compra',
        'id_proveedor',
        'user_id'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function egresos()
    {
        return $this->belongsToMany(egresos::class, 'compra_egresos', 'id_compra', 'id_egreso')
                    ->withTimestamps();
    }
}
