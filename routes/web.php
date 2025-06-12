<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactListController;
use App\Http\Controllers\ContactImportController; 
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ContactController;
use App\Models\ContactList;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;

Route::get('/campaigns/export', [CampaignController::class, 'export']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/campaigns', [CampaignController::class, 'index']);
Route::get('/campaigns/create', [CampaignController::class, 'create']);
Route::post('/campaigns', [CampaignController::class, 'store']);
Route::get('/campaigns/{id}', [CampaignController::class, 'show']);
Route::get('/contact-lists/create', [ContactListController::class, 'create']);
Route::post('/contact-lists', [ContactListController::class, 'store']);
Route::get('/contacts/{id}/edit', [ContactController::class, 'edit']);
Route::put('/contacts/{id}', [ContactController::class, 'update']);
Route::get('/download-template', function () {
    $path = storage_path('app/templates/contact_template.csv');

    if (!file_exists($path)) {
        abort(404, 'Template file not found.');
    }
    return Response::download($path);
});
Route::post('/contact-lists/{id}/import', [ContactImportController::class, 'import']);
Route::get('/contacts-ui/{id}', [ContactListController::class, 'viewUI']);
Route::get('/', function () {
    $lists = ContactList::withCount('contacts')->get();
    return view('welcome', compact('lists'));
});
Route::get('/contact-lists/{id}/edit', [ContactListController::class, 'edit']);
Route::put('/contact-lists/{id}', [ContactListController::class, 'update']);
Route::post('/contact-lists/{id}/add-contact', [ContactListController::class, 'addContact']);
Route::delete('/contact-lists/{list_id}/remove-contact/{contact_id}', [ContactListController::class, 'removeContact']);
Route::delete('/contact-lists/{id}', [ContactListController::class, 'destroy']);
Route::get('/campaigns/{id}/edit', [CampaignController::class, 'edit']);
Route::put('/campaigns/{id}', [CampaignController::class, 'update']);
Route::delete('/campaigns/{id}', [CampaignController::class, 'destroy']);
Route::get('/dashboard', [DashboardController::class, 'index']);