<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OtherDetails;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::any('/', [AdminController::class, 'login'])->name('login');
    Route::any('/logout', [AdminController::class, 'logout'])->name('logout');

    // Category
    Route::any('/category/{status?}/{id?}', [AdminController::class, 'category'])->name('category');

    // Sub Category
    Route::any('/subcategory/{status?}/{id?}', [AdminController::class, 'subcategory'])->name('subcategory');

    // Subject
    Route::any('/subject/{status?}/{id?}', [AdminController::class, 'subject'])->name('subject');
    Route::any('/get_subcategories/{categoryId}', [AdminController::class, 'getSubcategories'])->name('get-subcategory');
    // News
    Route::any('/news/{status?}/{id?}', [AdminController::class, 'news'])->name('news');
    Route::any('/addnews/{status?}/{id?}', [AdminController::class, 'addnews'])->name('addnews');
    Route::any('/updatenews/{id?}', [AdminController::class, 'updatenews'])->name('updatenews');

    // Gallery
    Route::any('/gallery/{status?}/{id?}', [AdminController::class, 'gallery'])->name('gallery');

    // Subject Routes
    Route::any('/test/{id?}/{status?}', [AdminController::class, 'test'])->name('test');
    Route::any('/quiz/{id?}/{status?}', [AdminController::class, 'quiz'])->name('quiz');

    // video url
    Route::any('/video_url/{id?}/{status?}', [AdminController::class, 'video_url'])->name('video_url');
});



Route::prefix('admin')->group(function () {
    Route::any('/other_details/{route?}', [OtherDetails::class, 'aboutus'])->name('aboutus');
    Route::any('/homebanner/{status?}/{id?}', [OtherDetails::class, 'homebanner'])->name('homebanner');
});
Route::prefix('admin')->group(function () {
    Route::any('/subscription/{status?}/{id?}', [SubscriptionController::class, 'subscription'])->name('subscription');
});






Route::post('ajaxModal/{parameter}', function (Request $request, $parameter) {
    if (View::exists($parameter)) {

        return view($parameter, ['request' => $request->all()]);
    } else {
        abort(404);
    }
});
Route::post('files/{bladePath}', function (Request $request, $bladePath) {
    if (View::exists('dropdown_files/' . $bladePath)) {
        return view('dropdown_files/' . $bladePath, ['request' => $request->all()]);
    } else {
        abort(404);
    }
});

Route::get('admin/{bladePath}', function ($bladePath) {
    if (View::exists($bladePath)) {
        return view($bladePath);
    } else {
        abort(404);
    }
});
