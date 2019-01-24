<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnuncioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'producto' => 'required|min:5',
            'id_categoria' => 'required|exists:categorias,id',
            'precio' => 'required|min:1',
            'nuevo' => 'required',
            'descripcion' => 'required|min:10|max:500',
            'id_vendedor' => 'required|exists:users,id',
        ];
    }
}
