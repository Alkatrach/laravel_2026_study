<?php

use App\Http\Controllers\TurtleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/turtles');
Route::resource('turtles', TurtleController::class);
