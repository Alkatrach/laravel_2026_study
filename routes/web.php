<?php

use App\Http\Controllers\TurtleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/items');
Route::resource('items', TurtleController::class);