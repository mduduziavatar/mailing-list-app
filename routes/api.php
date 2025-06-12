<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactImportController;
use App\Http\Controllers\ContactListController;

Route::get('/ping', fn() => ['pong' => true]);
Route::post('/contact-lists/{id}/import', [ContactImportController::class, 'import']);
Route::get('/contact-lists/{id}/filter', [ContactListController::class, 'filterContacts']);
Route::get('/contact-lists/{id}/contacts', [ContactListController::class, 'showContacts']);