<?php

use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/rumah-sehat');

Route::get('/consultation/{consultation}/print', [ConsultationController::class, 'print'])
    ->name('consultation.print');
