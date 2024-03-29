<?php
use Illuminate\Support\Facades\Route;


Route::get('',\App\Http\Livewire\Panel\Admin\Dashboard\Dashboard::class)->name('dashboard');
/////////////////////////////// Category
Route::prefix('category')
->name('category.')
->group(function () {
	Route::get('',\App\Http\Livewire\Panel\Admin\Category\Index::class)->name('index');
	Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\Category\Update::class)->name('update');
	Route::get('trashed',\App\Http\Livewire\Panel\Admin\Category\Trashed::class)->name('trashed');
});
/////////////////////////////// SubCategory
Route::prefix('subCategory')
	->name('subCategory.')
	->group(function () {
		Route::get('',\App\Http\Livewire\Panel\Admin\SubCategory\Index::class)->name('index');
		Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\SubCategory\Update::class)->name('update');
		Route::get('trashed',\App\Http\Livewire\Panel\Admin\SubCategory\Trashed::class)->name('trashed');
	});
/////////////////////////////// ChildCategory
Route::prefix('childCategory')
	 ->name('childCategory.')
	 ->group(function () {
		 Route::get('',\App\Http\Livewire\Panel\Admin\ChildCategory\Index::class)->name('index');
		 Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\ChildCategory\Update::class)->name('update');
		 Route::get('trashed',\App\Http\Livewire\Panel\Admin\ChildCategory\Trashed::class)->name('trashed');
	 });
/////////////////////////////// Activity Log
Route::prefix('log')
	->name('log.')
	->group(function () {
		Route::get('',\App\Http\Livewire\Panel\Admin\Log\Index::class)->name('index');
	});
Route::prefix('brand')
	->name('brand.')
	->group(function () {
		Route::get('',\App\Http\Livewire\Panel\Admin\Brand\Index::class)->name('index');
		Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\Brand\Update::class)->name('update');
		Route::get('trash',\App\Http\Livewire\Panel\Admin\Brand\Trash::class)->name('trashed');
	});
/////////////////////////////// Product
Route::prefix('product')
	->name('product.')
	->group(function () {
		Route::get('',\App\Http\Livewire\Panel\Admin\Product\Index::class)->name('index');
		Route::get('form',\App\Http\Livewire\Panel\Admin\Product\Form::class)->name('form');
		Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\Product\Update::class)->name('update');
		Route::get('trash',\App\Http\Livewire\Panel\Admin\Product\Trashed::class)->name('trashed');
	});