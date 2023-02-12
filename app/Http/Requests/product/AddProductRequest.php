<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest {
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
			'title' => [
				'required' ,
				'unique:products,title' ,
			] ,
			'price' => [
				'required' ,
				'numeric' ,
			] ,
			'discount' => [
				'nullable' ,
				'numeric' ,
			] ,
			'link' => [ 'nullable' ] ,
			'category_id' => [
				'required' ,
				'exists:categories,id' ,
			] ,
			'sub_category_id' => [
				'required' ,
				'exists:sub_categories,id' ,
			] ,
			'child_category_id' => [
				'nullable' ,
				'exists:child_categories,id' ,
			] ,
			'brand_id' => [ 'required' ] ,
			'type_of_quality' => [ 'required' ] ,
			'order_count' => [ 'required' ] ,
			'stock' => [ 'required' ] ,
			'special' => [
				'nullable' ,
				'boolean',
			] ,
			'gift' => [
				'nullable' ,
				'boolean',
			] ,
			'is_published' => [
				'nullable' ,
				'boolean',
			] ,
		];
	}
	
	public function messages () {
		return [
			'title.required' => 'عنوان محصول را وارد کنید.' ,
			'title.unique' => 'این عنوان قبلا در سیستم ثبت شده است.' ,
			'price.required' => 'قیمت محصول را وارد کنید.' ,
			'price.numeric' => 'قیمت محصول باید عدد لاتین باشد.' ,
			'discount.numeric' => 'قیمت تخفیف محصول باید عدد لاتین باشد.' ,
			'category_id.required' => 'دسته بندی را وارد کنید' ,
			'sub_category_id.required' => 'زیر دسته بندی را وارد کنید' ,
			'child_category_id.required' => ' دسته بندی  کودک را وارد کنید' ,
			'brand_id.required' => 'برند محصول انتخاب وارد کنید' ,
			'type_of_quality.required' => 'کیفیت محصول را انتخاب کنید' ,
			'stock.required' => 'تعداد موجودی محصول را وارد کنید' ,
			'order_count.required' => 'حداقل تعداد سفارش را وارد کنید' ,
		];
	}
}
