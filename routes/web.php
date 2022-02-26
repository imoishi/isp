<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Locale
Route::get('/locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back()->with('success', trans('trans.language_changed_successfully'));
})->name('locale.set');


Route::get('/', 'HomeController@index');
Route::get('/about-us', 'HomeController@showAboutUs');
Route::get('/package', 'HomeController@showPackage');
Route::get('/contact', 'HomeController@showContact');

// ==============================================================
// Helper Section
// ==============================================================
//Helper routes with eager loading
Route::get('/divisions/all', 'DivisionController@allDivisions')->name('divisions.all');
Route::get('/divisions/{division}/districts', 'DistrictController@divisionDistricts')->name('divisions.districts.all');
Route::get('/districts/{district}/upazilas', 'UpazilaController@districtUpazilas')->name('districts.upazilas.all');

// ==============================================================
// Auth Section
// ==============================================================
Auth::routes(['register' => false]);
//Route::get('/admin', 'Admin\AdminController@index')->name('admin');
Route::get('/admin/login', 'Auth\AdminLoginController@adminLogin')->name('admin.login');

Route::group(['middleware' => ['auth']], function () {

// ==============================================================
// Admin Section
// ==============================================================
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// ==============================================================
// Roles Section
// ==============================================================
Route::resource('/roles', 'RoleController');

// ==============================================================
// Users Section
// ==============================================================
Route::get('/users/{user}/profile', 'UserController@profile')->name('users.profile');
Route::put('/users/{user}/profile-update', 'UserController@profileUpdate')->name('users.profile-update');
Route::post('/users/{user}/password-update', 'UserController@passwordUpdate')->name('users.password-update');
Route::get('/users/{user}/status-update', 'UserController@statusUpdate')->name('users.status-update');
Route::resource('/users', 'UserController');

// ==============================================================
// Categories Section
// ==============================================================
//Route::get('/categories/status/update/{category}', 'CategoryController@statusUpdate')->name('categories.status.update');
//Route::resource('/categories', 'CategoryController');

// ==============================================================
// Package Section
// ==============================================================
    Route::get('/packages/status/update/{package}', 'PackageController@statusUpdate')->name('packages.status.update');
    Route::resource('/packages', 'PackageController');

//
//// ==============================================================
//// Houses Section
//// ==============================================================
//Route::get('/houses/status/update/{house}', 'HouseController@statusUpdate')->name('houses.status.update');
//Route::resource('/houses', 'HouseController');
//
//// ==============================================================
//// Division/District/Thana/City Section
//// ==============================================================
//Route::post('/district', 'HouseController@getDistrict');
//Route::post('/thana', 'HouseController@getThana');

// ==============================================================
// Settings Section
// ==============================================================
Route::resource('/settings', 'SettingController');

// ==============================================================
// Division Section
// ==============================================================
Route::get('/divisions/{division}/status/update', 'DivisionController@statusUpdate')->name('divisions.status-update');
Route::get('/divisions', 'DivisionController@index')->name('divisions.index');

// ==============================================================
// District Section
// ==============================================================
Route::get('/districts/{district}/status/update', 'DistrictController@statusUpdate')->name('districts.status-update');
Route::get('/districts', 'DistrictController@index')->name('districts.index');

// ==============================================================
// Upazila Section
// ==============================================================
Route::get('/upazilas/{upazila}/status/update', 'UpazilaController@statusUpdate')->name('upazilas.status-update');
Route::get('/upazilas', 'UpazilaController@index')->name('upazilas.index');

// ==============================================================
// Customer Section
// ==============================================================
//Route::get('customers', 'Cus/tomerController');
Route::get('/customers/status/update/{customer}', 'CustomerController@statusUpdate')->name('customers.status.update');
Route::resource('customers', 'CustomerController');


// ==============================================================
// ExpenseType Section
// ==============================================================
    Route::get('/expenseTypes/status/update/{expenseType}', 'ExpenseTypeController@statusUpdate')->name('expenseTypes.status.update');
    Route::resource('/expenseTypes', 'ExpenseTypeController');

// ==============================================================
// Expense Section
// ==============================================================
    Route::get('/expenses/status/update/{expense}', 'ExpenseController@statusUpdate')->name('expenses.status.update');
    Route::resource('/expenses', 'ExpenseController');

// ==============================================================
// Bill Section
// ==============================================================
    Route::resource('/bills', 'BillController');

// ==============================================================
// Report Section
// ==============================================================
    Route::get('/reports', 'ReportController@index')->name('reports.index');

// ==============================================================
// Area Section
// ==============================================================
    Route::resource('/areas', 'AreaController');

// ==============================================================
// Slider Section
// ==============================================================
    Route::get('/sliders/{slider}/status/update', 'SliderController@statusUpdate')->name('sliders.status.update');
    Route::resource('/sliders', 'SliderController');
});



