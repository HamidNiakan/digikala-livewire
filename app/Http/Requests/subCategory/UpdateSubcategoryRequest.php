<?php

namespace App\Http\Requests\subCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubcategoryRequest extends FormRequest
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
    public function rules(int $subCategoryId)
    {
		return [
			'subCategory.title' => 'required|unique:sub_categories,title,'.$subCategoryId,
			'subCategory.slug' => 'required|regex:/^[a-zA-Z-]+$/u|unique:sub_categories,slug,'.$subCategoryId,
			'subCategory.link' => 'required|regex:/^[a-zA-Z-]+$/u|unique:sub_categories,link,'.$subCategoryId,
			'subCategory.category_id' => 'required|exists:categories,id',
			'icon' => 'nullable|image|mimes:png,jpg,jpeg',
			'subCategory.is_published' => 'boolean'
		];
    }
	
	public function messages () {
		return [
			'subCategory.title.required' => 'عنوان زیر دسته بندی را وارد کنید',
			'subCategory.title.unique' => 'این عنوان زیر دسته بندی قبلا در سیستم ثبت شده است',
			'subCategory.title.string' => 'عنوان زیر دسته بندی باید کارکتر باشد',
			'subCategory.slug.required' => 'نام زیر دسته بندی را وارد کنید',
			'subCategory.slug.regex' => 'نام زیر دسته بندی باید لاتین باشید',
			'subCategory.slug.unique' => 'این نام زیر دسته بندی قبلا در سیستم ثبت شده است',
			'subCategory.slug.string' => 'نام زیر دسته بندی باید کارکتر باشد',
			'subCategory.link.required' => 'لینک زیر دسته بندی را وارد کنید',
			'subCategory.link.unique' => 'این لینک زیر قبلا در سیستم ثبت شده است',
			'subCategory.link.regex' => 'لینک زیر دسته بندی باید لاتین باشد',
			'icon.image' => 'فایل زیر آپلودی باید از نوع عکس باشد',
			'icon.mimes' => 'فایل زیر آپلودی باید از نوع عکس باشد',
			'subCategory.category_id' => 'دسته اصلی را انتخاب کنید',
		];
	}
}
