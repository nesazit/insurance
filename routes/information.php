<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->prefix('information')->group(function () {
    Route::get('/', [ProfileController::class, 'createInformation'])->name('information.create');

    Route::post('/', [ProfileController::class, 'storeInformation'])->name('information.store');
    Route::put('{information}', [ProfileController::class, 'updateInformation'])->name('information.update');

    Route::get('/lists', [ProfileController::class, 'informationLists'])->name('information.lists');
});

Route::middleware('auth')->prefix('insurance')->group(function () {

    Route::get('/', [ProfileController::class, 'userInsurance'])->name('user.insurances');
    Route::post('/', [ProfileController::class, 'buyInsurance'])->name('user.buy.insurance');
});
