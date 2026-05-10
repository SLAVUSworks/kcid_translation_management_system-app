<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\json\translation\QuestController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::resource('quests', QuestController::class);
    
    // Import/Export routes
    Route::get('quests/export/json', [QuestController::class, 'export'])->name('quests.export');
    Route::get('quests/import/form', [QuestController::class, 'showImport'])->name('quests.import.form');
    Route::post('quests/import/process', [QuestController::class, 'import'])->name('quests.import');
    Route::post('quests/batch-delete', [QuestController::class, 'batchDelete'])->name('quests.batch-delete');
});