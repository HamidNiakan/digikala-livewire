<?php

namespace App\Http\Requests\childCategory;

use Illuminate\Foundation\Http\FormRequest;

class AddChildCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
		return [
			'childCategory.title' => 'required|unique:sub_categories,title',
			'childCategory.slug' => 'required|unique:sub_categories,slug|regex:/^[a-zA-Z-]+$/u',
			'childCategory.link' => 'required|unique:sub_categories,link|regex:/^[a-zA-Z-]+$/u',
			'childCategory.sub_category_id' => 'required|exists:sub_categories,id',
			'icon' => 'required|image|mimes:png,jpg,jpeg',
			'childCategory.is_published' => 'boolean'
		];
    }
	
	public function messages () {
		return [
			'childCategory.title.required' => 'عنوان دسته بندی کودک را وارد کنید',
			'childCategory.title.unique' => 'این عنوان دسته بندی کودک قبلا در سیستم ثبت شده است',
			'childCategory.title.string' => 'عنوان دسته بندی کودک باید کارکتر باشد',
			'childCategory.slug.required' => 'نام دسته بندی کودک را وارد کنید',
			'childCategory.slug.regex' => 'نام دسته بندی کودک باید لاتین باشید',
			'childCategory.slug.unique' => 'این نام دسته بندی کودک قبلا در سیستم ثبت شده است',
			'childCategory.slug.string' => 'نام دسته بندی کودک باید کارکتر باشد',
			'childCategory.link.required' => 'لینک دسته بندی  کودک را وارد کنید',
			'childCategory.link.unique' => 'این لینک دسته بندی کودک قبلا در سیستم ثبت شده است',
			'childCategory.link.regex' => 'لینک دسته بندی کودک باید لاتین باشد',
			'icon.required' => 'ایکون دسته بندی  کودک را آپلود کنید',
			'icon.image' => 'فایل  آپلودی باید از نوع عکس باشد',
			'icon.mimes' => 'فایل  آپلودی باید از نوع عکس باشد',
			'childCategory.sub_category_id' => 'زیر دسته بندی را انتخاب کنید',
		];
	}
}
