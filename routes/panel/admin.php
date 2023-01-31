<?php
use Illuminate\Support\Facades\Route;


Route::get('',\App\Http\Livewire\Panel\Admin\Dashboard\Dashboard::class)->name('dashboard');
Route::prefix('category')
->name('category.')
->group(function () {
	Route::get('',\App\Http\Livewire\Panel\Admin\Category\Index::class)->name('index');
	Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\Category\Update::class)->name('update');
	Route::get('trashed',\App\Http\Livewire\Panel\Admin\Category\Trashed::class)->name('trashed');
});
Route::prefix('subCategory')
	->name('subCategory.')
	->group(function () {
		Route::get('',\App\Http\Livewire\Panel\Admin\SubCategory\Index::class)->name('index');
		Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\SubCategory\Update::class)->name('update');
		Route::get('trashed',\App\Http\Livewire\Panel\Admin\SubCategory\Trashed::class)->name('trashed');
	});
Route::prefix('childCategory')
	 ->name('childCategory.')
	 ->group(function () {
		 Route::get('',\App\Http\Livewire\Panel\Admin\ChildCategory\Index::class)->name('index');
		 Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\ChildCategory\Update::class)->name('update');
		 Route::get('trashed',\App\Http\Livewire\Panel\Admin\ChildCategory\Trashed::class)->name('trashed');
	 });
Route::prefix('log')
	->name('log.')
	->group(function () {
		Route::get('',\App\Http\Livewire\Panel\Admin\Log\Index::class)->name('index');
	});