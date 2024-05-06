<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\FoController;
use App\Http\Controllers\LeadsController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminController::class)->group(function () {

    Route::get('/', 'dashboard')->name('dashboard');
    Route::post('/adminloginpost', 'adminloginpost')->name('adminloginpost');
    Route::get('/adminlogout', 'adminlogout')->name('adminlogout');
});
Route::controller(FoController::class)->group(function () {
    Route::any('/allfo', 'allFo')->name('allFo');
    Route::any('/addFo', 'addFo')->name('addFo');
    Route::any('/activefo', 'activeFo')->name('activeFo');
    Route::any('/inactivefo', 'inActiveFo')->name('inActiveFo');
    Route::any('/fochagestatus/{id}', 'fochagestatus')->name('fochagestatus');
    Route::any('/editfo/{id?}', 'editFo')->name('editFo');
    Route::any('foleads/{id?}', 'foleads')->name('foleads');

});

Route::controller(LeadsController::class)->group(function () {

    Route::get('/allleads', 'allLeads')->name('allLeads');
    Route::any('/addleads', 'addLeads')->name('addLeads');
    Route::any('/openleads', 'openLeads')->name('openLeads');
    Route::any('/closeleads', 'closeLeads')->name('closeLeads');
    Route::any('/timeoutleads', 'timeoutLeads')->name('timeoutLeads');
    Route::any('/notassignaeads', 'notAssignLeads')->name('notAssignLeads');
    Route::any('/leadschagestatus/{id}', 'leadschagestatus')->name('leadschagestatus');
    Route::any('editleads/{id?}', 'editleads')->name('editleads');
});

Route::controller(ExcelController::class)->group(function () {

    Route::any('/importleads', 'importleads')->name('importleads');


    Route::any('/export/{status?}/{fo_id?}', 'export')->name('export');
});
