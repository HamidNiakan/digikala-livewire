<?php
use Illuminate\Support\Facades\Route;


Route::get('',\App\Http\Livewire\Panel\Admin\Dashboard\Dashboard::class)->name('dashboard');
Route::prefix('category')
->name('category.')
->group(function () {
	Route::get('',\App\Http\Livewire\Panel\Admin\Category\Index::class)->name('index');
	Route::get('update/{slug}',\App\Http\Livewire\Panel\Admin\Category\Update::class)->name('update');
});