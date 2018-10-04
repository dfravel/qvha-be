<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
});

// temporarily moving these out of the login section
Route::apiResource('addresses', 'AddressController');
Route::get('address/{address}/contacts', 'GetContactsByAddress');
Route::apiResource('contacts', 'ContactController');
Route::apiResource('committees', 'CommitteeController');
Route::apiResource('users', 'UserController');

Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');

    // Single Action Controllers
    Route::get('address/{address}/dues', 'GetDuesByAddress');
    Route::get('email-list', 'GetEmailList');
    Route::post('assign-committee', 'AssignContactToCommittee');

    // Resourceful Controllers

});



// fallback route for 404
// added a handler in app/exceptions/handler to also handle ModelNotFoundException
Route::fallback(function () {
    return response()->json(['message' => 'Record not found'], 404);
})->name('api.fallback.404');
