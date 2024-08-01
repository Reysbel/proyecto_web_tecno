<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;

    protected $table = 'metodo_pago';
    protected $primaryKey = 'id_metodo_pago';

    protected $fillable = [
        'tipo',
        'imagen',
    ];

    /**
     * Get the invoices that use this payment method.
     */
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'metodo_pago');
    }
}
