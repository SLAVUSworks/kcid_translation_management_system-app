<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\translation\DashboardController as TranslationDashboardController;
use App\Http\Controllers\translation\ExpeditionDescController;
use App\Http\Controllers\translation\FurnitureDescController;
use App\Http\Controllers\translation\ItemController;
use App\Http\Controllers\translation\QuestController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/modules', [TranslationDashboardController::class, 'index'])
        ->name('admin.modules');

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

    Route::resource('expedition-descs', ExpeditionDescController::class);

    Route::get('expedition-descs/export/json', [ExpeditionDescController::class, 'export'])->name('expedition-descs.export');
    Route::get('expedition-descs/import/form', [ExpeditionDescController::class, 'showImport'])->name('expedition-descs.import.form');
    Route::post('expedition-descs/import/process', [ExpeditionDescController::class, 'import'])->name('expedition-descs.import');
    Route::post('expedition-descs/batch-delete', [ExpeditionDescController::class, 'batchDelete'])->name('expedition-descs.batch-delete');

    Route::resource('items', ItemController::class);

    Route::get('items/export/json', [ItemController::class, 'export'])->name('items.export');
    Route::get('items/import/form', [ItemController::class, 'showImport'])->name('items.import.form');
    Route::post('items/import/process', [ItemController::class, 'import'])->name('items.import');
    Route::post('items/batch-delete', [ItemController::class, 'batchDelete'])->name('items.batch-delete');

    Route::middleware('admin')->group(function () {
        Route::get('users', [UserManagementController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.updateRole');
    });
});

require __DIR__.'/auth.php';
