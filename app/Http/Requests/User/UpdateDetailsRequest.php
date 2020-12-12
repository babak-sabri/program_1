<?php
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailsRequest extends FormRequest
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
			'citizenship_country_id'	=> 'integer|exists:countries,id',
			'first_name'				=> 'nullable|string|max:255',
			'last_name'					=> 'nullable|string|max:255',
			'phone_number'				=> 'nullable|string|max:255',
		];
	}
}