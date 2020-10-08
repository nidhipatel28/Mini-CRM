<?php

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

Route::get('/', function () {
    return redirect('companies');
});

Route::get('logout', '\App\Http\Controllers\LoginController@logout')->name('logout');

// routes for company
Route::group(['middleware' => ['auth']], function () {
    Route::get('/companies',  'App\Http\Controllers\CompaniesController@index')->name('companies');
    Route::get('/companies/add',  'App\Http\Controllers\CompaniesController@create')->name('addViewCompany');
    Route::post('/store-companies/{id?}',  'App\Http\Controllers\CompaniesController@store')->name('storeCompanies');
    Route::post('/delete-companies/{id}', 'App\Http\Controllers\CompaniesController@destroy')->name('deleteCompanies');
    Route::get('/companies/view/{id}', 'App\Http\Controllers\CompaniesController@show')->name('viewCompanies');
    Route::get('/companies/edit/{id}', 'App\Http\Controllers\CompaniesController@edit')->name('editCompanies');

    // routes for employees
    Route::get('/employees',  'App\Http\Controllers\EmployeesController@index')->name('employees');
    Route::get('/employees/add',  'App\Http\Controllers\EmployeesController@create')->name('addViewEmploye');
    Route::post('/store-employees/{id?}',  'App\Http\Controllers\EmployeesController@store')->name('storeEmployees');
    Route::post('/delete-employees/{id}', 'App\Http\Controllers\EmployeesController@destroy')->name('deleteEmployees');
    Route::get('/employees/view/{id}', 'App\Http\Controllers\EmployeesController@show')->name('viewEmployees');
    Route::get('/employees/edit/{id}', 'App\Http\Controllers\EmployeesController@edit')->name('editEmployees');
});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
