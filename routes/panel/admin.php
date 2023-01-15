<?php
use Illuminate\Support\Facades\Route;


Route::get('',\App\Http\Livewire\Panel\Admin\Dashboard\Dashboard::class)->name('dashboard');