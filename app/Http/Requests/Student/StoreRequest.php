<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [
        'name'  => ['required', 'string', 'max:255'],
        'nis'   => ['required', 'string', 'size:4', 'unique:students,nis'],
        'class' => ['required', 'string', 'max:50'],
        'major' => ['required', 'string', 'in:AKL,BiD,TKJ'],
    ];
}
}
