<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameResultCancelRequest extends FormRequest
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
            'cancel-GameRound' => 'required|numeric',
            'cancel-GameRun' => 'required|numeric'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'cancel-GameRound.required'     => '輪號是必填欄位',
            'cancel-GameRound.numeric'     => '輪號必須為數字',
            'cancel-GameRun.required'     => '局號是必填欄位',
            'cancel-GameRun.numeric'     => '局號必須為數字'
        ];
    }
}
