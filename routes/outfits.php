<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutfitGeneratorController;

Route::middleware('auth')->group(function () {
    // Generador de Outfits
    Route::get('/generate-outfits', [OutfitGeneratorController::class, 'showGenerator'])->name('outfits.generator');
    Route::post('/generate-outfits/process', [OutfitGeneratorController::class, 'generateOutfits'])->name('outfits.process');
    Route::get('/generate-outfits/results', [OutfitGeneratorController::class, 'showResults'])->name('outfits.results');
});