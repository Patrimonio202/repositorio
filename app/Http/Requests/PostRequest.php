<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ExtensionPermitida;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // if ($this->user_id == auth()->user()->id) {
        //     return true;
        // }else{
        //     return false;
        // }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $post = $this->route()->parameter('post');

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts', // ,slug,$category->id",
            'anocreacion' => 'required',
            'autor' => 'required',
            'status' => 'required|in:1,2',
            // parche-subidas v1.0 (30/10/2026): tipo y extension permitidos
            'file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', new ExtensionPermitida(['jpg', 'jpeg', 'png', 'webp', 'gif'])],
            'archivo' => ['nullable', 'file', 'mimes:pdf,mp3,mpga,wav,ogg,m4a,aac', new ExtensionPermitida(['pdf', 'mp3', 'wav', 'ogg', 'm4a', 'aac'])],
        ];

        //si tiene informacion en el post, agregamos la siguiente validacion
        if ($post) {
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }


        if ($this->status == 2) {
            if (!$post) { //validamos esto solo cuando se crea
                if ($this->category_id == 1 || $this->category_id == 2 || $this->category_id == 3) { // este es para las imagenes
                    $rules['file'] = ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', new ExtensionPermitida(['jpg', 'jpeg', 'png', 'webp', 'gif'])];
                }

                if ($this->category_id == 2 || $this->category_id == 3) { // este es para los adjuntos de audio y libros
                    $rules['archivo'] = ['required', 'file', 'mimes:pdf,mp3,mpga,wav,ogg,m4a,aac', new ExtensionPermitida(['pdf', 'mp3', 'wav', 'ogg', 'm4a', 'aac'])];
                }
                if ($this->category_id == 4) { // este es para archivos de youtube
                    $rules['urlyoutube'] = 'required';
                }
            }

            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'body' => 'required',
                'tema_id' => 'required',
                'destacada' => 'required|in:1,2'
            ]); //lo que hace es fucionar 2 arrays
        }

        return $rules;
    }
}
