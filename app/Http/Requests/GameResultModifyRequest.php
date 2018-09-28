<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameResultModifyRequest extends FormRequest
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
            'modify-TableId' => 'required',
            'modify-GameRound' => 'required|numeric',
            'modify-GameRun' => 'required|numeric',
            'modify-ModifiedStatus' => 'required',
            'modify-GameSelect' => 'required',
            'player-card-1' => 'required',
            'banker-card-1' => 'required',
            'player-card-2' => 'required',
            'banker-card-2' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'modify-TableId.required' => '桌號是必填欄位',
            'modify-GameRound.required' => '輪號是必填欄位',
            'modify-GameRun.required' => '局號是必填欄位',
            'modify-GameRound.numeric' => '輪號必須是數字',
            'modify-GameRun.numeric' => '輪號必須是數字',
            'modify-ModifiedStatus' => '牌局狀態是必填欄位',
            'modify-GameSelect' => 'Casino遊戲選擇是必填欄位',
            'player-card-1.required' => '閒家第一張牌是必填欄位',
            'banker-card-1.required' => '莊家第一張牌是必填欄位',
            'player-card-2.required' => '閒家第二張牌是必填欄位',
            'banker-card-2.required' => '莊家第二張牌是必填欄位',
        ];
    }
}
