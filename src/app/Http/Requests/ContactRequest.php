<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // お名前
            //'last_name'  => ['required'],
            //'first_name' => ['required'],

            // 性別
            //'gender_value' => ['required'],

            // メールアドレス
            //'email' => ['required', 'email'],

            // 電話番号（3つすべて必須）
            //'tel1' => ['required', 'numeric', 'digits_between:1,5'],
            ////'tel2' => ['required', 'numeric', 'digits_between:1,5'],
            //'tel3' => ['required', 'numeric', 'digits_between:1,5'],

            // 住所
            //'address' => ['required'],

            // 建物名（任意入力） → ルールなし

            // お問い合わせ種類
            //'category_value' => ['required'],

            // お問い合わせ内容
            //'content' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required'  => '姓を入力してください',
            'first_name.required' => '名を入力してください',

            
            'gender_value.required' => '性別を選択してください',

            
            'email.required' => 'メールアドレスを入力してください',
            'email.email'    => 'メールアドレスはメール形式で入力してください',

            
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',

            'tel1.numeric' => '電話番号は 半角英数字で入力してください',
            'tel2.numeric' => '電話番号は 半角英数字で入力してください',
            'tel3.numeric' => '電話番号は 半角英数字で入力してください',

            'tel1.digits_between' => '電話番号は 5桁まで数字で入力してください',
            'tel2.digits_between' => '電話番号は 5桁まで数字で入力してください',
            'tel3.digits_between' => '電話番号は 5桁まで数字で入力してください',

            
            'address.required' => '住所を入力してください',

           
            'category_value.required' => 'お問い合わせの種類を選択してください',

            
            'content.required' => 'お問い合わせ内容を入力してください',
            'content.max'      => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
