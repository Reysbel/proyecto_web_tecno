<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'image',
        'phone',
        'email',
        'role',
        'status',
        'password',
    ];

    /**
     * Get the invoices where the user is the vendor.
     */
    public function facturasVendidas()
    {
        return $this->hasMany(Factura::class, 'id_vendedor');
    }

    /**
     * Get the invoices where the user is the customer.
     */
    public function facturasCompradas()
    {
        return $this->hasMany(Factura::class, 'id_cliente');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
