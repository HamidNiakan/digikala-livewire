<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
    public function rules(int $categoryId)
    {
		return [
			'category.title' => 'required|unique:categories,title,'.$categoryId,
			'category.slug' => 'required|unique:categories,slug,'.$categoryId,
			'category.link' => 'required|unique:categories,link,'.$categoryId,
			'icon' => 'nullable|image|mimes:png,jpg,jpeg',
			'category.is_published' => 'boolean'
		];
    }
	
	public function messages () {
		return [
			'category.title.required' => 'عنوان دسته بندی را وارد کنید',
			'category.title.unique' => 'این عنوان دسته بندی قبلا در سیستم ثبت شده است',
			'category.title.string' => 'عنوان دسته بندی باید کارکتر باشد',
			'category.slug.required' => 'نام دسته بندی را وارد کنید',
			'category.slug.unique' => 'این نام دسته بندی قبلا در سیستم ثبت شده است',
			'category.slug.string' => 'نام دسته بندی باید کارکتر باشد',
			'category.link.required' => 'لینک دسته بندی را وارد کنید',
			'category.link.unique' => 'این لینک قبلا در سیستم ثبت شده است',
			'icon.required' => 'ایکون دسته بندی را آپلود کنید',
			'icon.image' => 'فایل آپلودی باید از نوع عکس باشد',
			'icon.mimes' => 'فایل آپلودی باید از نوع عکس باشد',
		];
	}
}
