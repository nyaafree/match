<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditItemRequest extends FormRequest
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
        // 単発案件を選択されている場合はlowPrice,highPriceカラムの両方にrequired|integerのバリデーションチェックを行う
        $priceValidate = $this->input('category_id') == 1 ? 'required|integer': '';
        return [
            'title' => 'required|max:100',
            'category_id' => 'required|integer',
            'detail' => 'required',
            'lowPrice' => $priceValidate,
            'highPrice' => $priceValidate,
        ];
    }

    public function messages()
    {
        return [
            'category_id.integer' => '単発案件かレベニューシアかを選択してください',
        ];

    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
           if(intval( $this->input('lowPrice') ) > intval( $this->input('highPrice') )){
              $validator->errors()->add('field', '最少価格が最大価格を上回っているので訂正してください');
           }

        });
    }


}
