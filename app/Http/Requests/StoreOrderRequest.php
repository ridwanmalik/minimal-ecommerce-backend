<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:user,id',
            'product.*' => 'required|integer|exists:product,id',
            'qty.*' => 'required|integer',
            'status' => 'string|in:pending,approved,rejected,processing,shipped,delivered',
        ];
    }
}
