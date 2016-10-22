<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
	        'name'		=> 'required|max:64',
	        'surname'	=> 'required|max:64',
	        'company'	=> 'max:64',
	        'email'		=> 'required|email|between:6,64|unique:users',
	        'phone'		=> 'required|max:32',
	        'password'	=> 'required|between:6,128',
	        'confirm' 	=> 'required|same:password'
        ];
    }

	/**
	 * Change validation errors messages
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'required'          => 'Поле :attribute обязательно к заполнению!',
			'name.max'          => 'Имя должно иметь максимум :max символа!',
			'surname.max'       => 'Фамилия должна иметь максимум :max символа!',
			'company.max'       => 'Компания должна иметь максимум :max символа!',
			'phone.max'         => 'Телефон должен иметь максимум :max символа!',
			'password.between'  => 'Пароль должен иметь :min - :max символов!',
			'confirm.same'      => 'Пароли должны совпадать!',
			'email.between'     => 'Email должен иметь :min - :max символов!',
			'email.unique'      => 'К сожалению, этот email уже занят!',
		];
	}
}
