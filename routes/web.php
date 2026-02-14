<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\SalesDashboard;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', SalesDashboard::class);
