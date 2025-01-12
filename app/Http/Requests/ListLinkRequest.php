<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'link' => 'required',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Only allow image files, max 2MB
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'link.required' => 'Link wajib diisi.',
            'path.required' => 'Foto wajib diunggah.',
            'path.image' => 'Foto yang diunggah harus berupa gambar.',
            'path.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'path.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }

}
