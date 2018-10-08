<?php

use Illuminate\Http\Request;

// default route from new project. leaving this in here for now
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('refresh', 'AuthController@refresh')->name('refresh');
});


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');

    // Single Action Controllers
    Route::get('address/{address}/dues', 'GetDuesByAddress');
    Route::get('email-list', 'GetEmailList');
    Route::get('address/{address}/contacts', 'GetContactsByAddress');
    Route::post('assign-committee', 'AssignContactToCommittee');

    // Resourceful Controllers
    // the apiResource wrapper only creates: index, store, update, delete
    Route::apiResource('addresses', 'AddressController');
    Route::apiResource('contacts', 'ContactController');
    Route::apiResource('committees', 'CommitteeController');
    Route::apiResource('users', 'UserController');
});



// fallback route for 404
// added a handler in app/exceptions/handler to also handle ModelNotFoundException
Route::fallback(function () {
    return response()->json(['message' => 'Record not found'], 404);
})->name('api.fallback.404');
