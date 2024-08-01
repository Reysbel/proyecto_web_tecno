<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraEgreso extends Model
{
    use HasFactory;

    protected $table = 'compra_egresos';

    protected $fillable = [
        'id_compra',
        'id_egreso'
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }

    public function egreso()
    {
        return $this->belongsTo(Egreso::class, 'id_egreso');
    }
}
