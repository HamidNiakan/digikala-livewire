<?php

namespace App\Http\Requests\brand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this
	 * request.
	 *
	 * @return bool
	 */
	public function authorize () {
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules ( $brandId ) {
		return [
			'brand.title' => [
				'required' ,
				'unique:brands,title,' . $brandId,
			] ,
			'icon' => 'nullable|mimes:png,jpg,jpeg,svg' ,
			'brand.description' => 'nullable' ,
			'brand.is_published' => 'boolean' ,
		];
	}
	
	public function messages () {
		return [
			'brand.title.required' => 'عنوان برند را وارد کنید' ,
			'brand.title.unique' => 'این عنوان قبلا در سیستم ثبت شده است' ,
			'icon.mimes' => 'پسوند ایکون باید png,jpg,jpeg و svg باشد' ,
		];
	}
}
