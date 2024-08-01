<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    // La tabla asociada con el modelo
    protected $table = 'page_views';

    // Las columnas que pueden ser asignadas masivamente
    protected $fillable = ['page_url', 'views'];
}
