<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\FileDownloadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage; // <-- WAJIB TAMBAH INI

Route::redirect('/', '/rumah-sehat');

Route::get('/consultation/{consultation}/print', [ConsultationController::class, 'print'])
    ->name('consultation.print');

Route::get('/download-file/{path}', function ($path) {
    $path = str_replace('|', '/', $path);

    if (! Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return Storage::disk('public')->download($path);
})->where('path', '.*')->name('file.download');

Route::get('/preview/{path}', function ($path) {
    $path = str_replace('|', '/', $path);

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(
        storage_path('app/public/' . $path)
    );
})->name('terapi.preview');






Route::get('/lab-download/{path}', function ($path) {
    $path = str_replace('|', '/', $path);
    if (! Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return Storage::disk('public')->download($path);
})->where('path', '.*')->name('lab.download');

Route::get('/data-lab-batch-download/{id}', [FileDownloadController::class, 'DataLabBatchDownload'])
    ->name('data-lab.batch.download');
Route::get('/lab/preview/{path}', [FileDownloadController::class, 'DataLabPreview'])
    ->name('lab.preview');
