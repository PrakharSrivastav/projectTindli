<?php
use Illuminate\Http\Request;

Route::get("/successful-registration/{token}","StaticController@registrationSuccess")->name("registered");
Route::post("/getLocations/{input}","StaticController@getLocationsApi")->name("getLocations");
Route::get("/how","StaticController@howItWorks")->name('how');
Route::get("/tnc","StaticController@termsAndCondition")->name('tnc');


Route::group(['middleware' => ['web']], function () {
	Route::get("/logout","TindliAuthController@logout")->name("logout");
	Route::post("/login","TindliAuthController@login")->name("attempt_login");
    Route::get('/', "StaticController@home")->name("home");
    Route::get('/login', "StaticController@login")->name("login");
    Route::get('/register', "StaticController@register")->name("register");
    Route::post('/signup',"StaticController@store")->name('signup');
    Route::get("/dashboard","MembersController@dashboard")->name('dashboard');
    Route::post("/search","ProcessDataController@search")->name('search');
    Route::any("/sender_order","ProcessDataController@prepareOrder")->name("sender_order");
    Route::get("/orders","ProcessDataController@getOrders")->name('orders');
    Route::get("/get_order/{order_name}","ProcessDataController@getOrder")->name('get_order');
    Route::get("messages","ProcessDataController@messages")->name("messages");
    Route::get("apply/{order_id}","ProcessDataController@applyForOrder")->name('apply');
    Route::get("cancel/{order_id}","ProcessDataController@cancelApplication")->name('cancel');
    Route::get("requests","ProcessDataController@getRequests")->name('requests');
    Route::get("mark-read","ProcessDataController@markAsRead")->name('markasread');
    Route::get("send-message","ProcessDataController@sendMessage")->name('send_message');
    Route::get("unread-messages","ProcessDataController@getUnreadMessages")->name('unread_messages');
	Route::get('auth/facebook', 'TindliAuthController@redirectToFacebook')->name('facebook');
	Route::get('auth/facebook/callback', 'TindliAuthController@handleFacebookCallback')->name('facebookCallback');
	Route::get('auth/google', 'TindliAuthController@redirectToGoogle')->name('google');
	Route::get('auth/google/callback', 'TindliAuthController@handleGoogleCallback')->name('googleCallback');
});
