<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'file' => 'image'
        ];

        //si tiene informacion en el post, agregamos la siguiente validacion
        if ($post) {
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }


        if ($this->status == 2) {
            if (!$post) { //validamos esto solo cuando se crea
                if ($this->category_id == 1 || $this->category_id == 2 || $this->category_id == 3) { // este es para las imagenes
                    $rules['file'] = 'image|required';
                }

                if ($this->category_id == 2 || $this->category_id == 3) { // este es para los adjuntos de audio y libros
                    $rules['archivo'] = 'required';
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
