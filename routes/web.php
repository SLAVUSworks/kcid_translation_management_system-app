<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\translation\QuestController;
use App\Http\Controllers\translation\FurnitureDescController;
use App\Http\Controllers\translation\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');    

    Route::resource('quests', QuestController::class);
    
    Route::get('quests/export/json', [QuestController::class, 'export'])->name('quests.export');
    Route::get('quests/import/form', [QuestController::class, 'showImport'])->name('quests.import.form');
    Route::post('quests/import/process', [QuestController::class, 'import'])->name('quests.import');
    Route::post('quests/batch-delete', [QuestController::class, 'batchDelete'])->name('quests.batch-delete');

    Route::resource('furniture-descs', FurnitureDescController::class);

    Route::get('furniture-descs/export/json', [FurnitureDescController::class, 'export'])->name('furniture-descs.export');
    Route::get('furniture-descs/import/form', [FurnitureDescController::class, 'showImport'])->name('furniture-descs.import.form');
    Route::post('furniture-descs/import/process', [FurnitureDescController::class, 'import'])->name('furniture-descs.import');
    Route::post('furniture-descs/batch-delete', [FurnitureDescController::class, 'batchDelete'])->name('furniture-descs.batch-delete');
});