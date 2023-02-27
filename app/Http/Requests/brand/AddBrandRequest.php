<?php

namespace App\Http\Requests\brand;

use Illuminate\Foundation\Http\FormRequest;

class AddBrandRequest extends FormRequest {
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
	public function rules () {
		return [
			'brand.title' => [
				'required' ,
				'unique:brands,title' ,
			] ,
			'icon' => 'required|mimes:png,jpg,jpeg,svg' ,
			'brand.description' => 'nullable' ,
			'brand.category_id' => 'required',
			'brand.is_published' => 'nullable',
		];
	}
	
	public function messages () {
		return [
			'brand.title.required' => 'عنوان برند را وارد کنید' ,
			'brand.title.unique' => 'این عنوان قبلا در سیستم ثبت شده است' ,
			'icon.required' => 'ایکون را انتخاب کنید' ,
			'icon.mimes' => 'پسوند ایکون باید png,jpg,jpeg و svg باشد' ,
			'brand.category_id' => 'دسته بندی را انتخاب کنید'
		];
	}
}
