<?php

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
    return view('index');
});

// Admin routes
Route::get('/Admin', 'BackController@adminHome');
Route::get('/Admin/addCloth', function (){
   return view('Admin.newcloth');
});
Route::post('/Admin/addCloth', 'BackController@addClothType');

Route::get('/Admin/viewCloth','BackController@viewCloth');

Route::get('/Admin/{id}/edit', 'BackController@editCloth');

Route::post('/Admin/editCloth/{id}','BackController@updateCloth');

Route::get('/Admin/addLaundry', function (){
    return view('Admin.newlaundry');
});

Route::post('/Admin/addLaundry', 'BackController@addLaundryType');

Route::get('/Admin/viewLaundry','BackController@viewLaundry');

Route::get('Admin/{id}/editLaundry','BackController@editLaundry');

Route::post('/Admin/editLaundry/{id}','BackController@updateLaundry');


Route::get('/Admin/addPrice', 'BackController@getPrice');
Route::post('/Admin/addPrice','BackController@addPrice');
Route::get('/Admin/viewPrice','BackController@viewPrice');
Route::get('Admin/{id}/editPrice','BackController@editPrice');
Route::post('/Admin/editPrice/{id}','BackController@updatePrice');



Route::get('/Admin/addOrder','BackController@getJobOrderForm');
Route::post('/Admin/addOrder','BackController@addOrders');

Route::get('//Admin/getTotalPrice/{cloth}/{laundry}','BackController@getTotalPrice');

Route::get('/Admin/viewOrders','BackController@viewOrders');
Route::get('/Admin/viewOrder/{id}','BackController@viewOrder');
Route::post('/Admin/recordLaunderer','BackController@recordLaunderer');
Route::get('/Admin/assignLaunderer/{id}','BackController@assignLaunderer');
Route::get('/Admin/markCompleted/{id}','BackController@markQCompleted');
Route::post('/Admin/recordAsCompleted','BackController@recordCompleted');



Route::get('/Admin/addEmployee', function (){
    return view('Admin.newemployee');
});

Route::post('/Admin/addEmployee', 'BackController@addEmployee');

Route::get('/Admin/viewEmployee','BackController@viewEmployee');

Route::get('Admin/{id}/editEmployee','BackController@editEmployee');

Route::post('/Admin/editEmployee/{id}','BackController@updateEmployee');



Route::get('/Admin/launderers','BackController@launderers');




Route::get('/Admin/addCustomer', function (){
    return view('Admin.newcustomer');
});

Route::post('/Admin/addCustomer', 'BackController@addCustomer');

Route::get('/Admin/viewCustomer','BackController@viewCustomer');

Route::get('Admin/{id}/editCustomer','BackController@editCustomer');

Route::post('/Admin/editCustomer/{id}','BackController@updateCustomer');


Route::get('/Admin/salesForm','BackController@salesForm');
Route::post('/Admin/recordSales','BackController@recordSales');
Route::get('/Admin/viewSales','BackController@viewSales');


Route::get('/Admin/addExpenses',function (){

    return view('Admin.addexpenses');

});

Route::post('/Admin/recordExpenses','BackController@recordExpenses');
Route::get('/Admin/viewExpenses','BackController@viewExpenses');

Route::get('/Admin/report',function (){

    return view('Admin.report');
});

Route::post('/Admin/getReport','BackController@getReport');

Route::get('/Admin/viewReport','BackController@viewReport');








Route::get('/Accountant', 'BackController@accHome');

Route::get('/Accountant/viewOrders','BackController@viewAccOrders');
Route::get('/Accountant/viewOrder/{id}','BackController@viewAccOrder');

Route::get('/Accountant/addExpenses',function (){

    return view('Accountant.addexpenses');

});

Route::post('/Accountant/recordExpenses','BackController@recordAccExpenses');
Route::get('/Accountant/viewExpenses','BackController@viewAccExpenses');

Route::get('/Accountant/salesForm','BackController@salesAccForm');
Route::post('/Accountant/recordSales','BackController@recordAccSales');
Route::get('/Accountant/viewSales','BackController@viewAccSales');




Route::get('/QualityControl','BackController@quaHome');

Route::get('/QualityControl/launderers','BackController@Qualaunderers');

Route::get('/QualityControl/viewOrders','BackController@viewQuaOrders');
Route::get('/QualityControl/viewOrder/{id}','BackController@viewQuaOrder');
Route::post('/QualityControl/recordLaunderer','BackController@recordQuaLaunderer');
Route::get('/QualityControl/assignLaunderer/{id}','BackController@assignQuaLaunderer');
Route::get('/QualityControl/markCompleted/{id}','BackController@markQuaCompleted');
Route::post('/QualityControl/recordAsCompleted','BackController@recordQuaCompleted');


Route::get('/Customer', 'BackController@cusHome');
Route::get('/Customer/viewOrder','BackController@cusViewOrder');





// Authentication routes...

Route::get('auth/login', function (){
    return view('index');
});

Route::post('auth/login', 'BackController@login');
Route::get('auth/logout', 'BackController@logout');

