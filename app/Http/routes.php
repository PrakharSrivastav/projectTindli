<?php
use Illuminate\Http\Request;

Route::get("/successful-registration/{token}","StaticController@registrationSuccess")->name("registered");
Route::post("/getLocations/{input}","StaticController@getLocationsApi")->name("getLocations");
Route::get("/how","StaticController@howItWorks")->name('how');

Route::group(['middleware' => ['web']], function () {
	Route::get("/logout","TindliAuthController@logout")->name("logout");
	Route::post("/login","TindliAuthController@login")->name("attempt_login");
    Route::get('/', "StaticController@home")->name("home");
    Route::get('/login', "StaticController@login")->name("login");
    Route::get('/register', "StaticController@register")->name("register");
    Route::post('/signup',"StaticController@store")->name('signup');
    Route::get("/dashboard","MembersController@dashboard")->name('dashboard');
    Route::post("/search","ProcessDataController@search")->name('search');
    Route::post("/sender_order","ProcessDataController@prepareOrder")->name("sender_order");
    Route::get("/orders","ProcessDataController@getOrders")->name('orders');
    Route::get("/get_order/{order_name}","ProcessDataController@getOrder")->name('get_order');
    Route::get("messages","ProcessDataController@messages")->name("messages");
});
