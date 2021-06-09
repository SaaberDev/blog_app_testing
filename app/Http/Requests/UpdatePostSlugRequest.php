<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostSlugRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => ['string', 'required'],
        ];
    }
}
