<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
], function()
{

    // Fortify routes
    require(base_path('vendor/laravel/fortify/routes/routes.php'));

    // Home page
    Route::get('/', [WebController::class, 'homePage'])->name('homePage');

    // Donors page
    Route::get('/donors', [WebController::class, 'donorsPage'])->name('donorsPage');
    Route::get('/donors/search', [WebController::class, 'donorsSearch'])->name('donorsSearch');

    //About page
    Route::get('/about', [WebController::class, 'aboutPage'])->name('aboutPage');

    //Loged in users routes
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/dashboard', [WebController::class, 'dashboard'])->name('dashboard');
    });
});


