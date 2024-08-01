<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Suponiendo que se permite la carga de imágenes
        ];
    }
}
