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

Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');

    // Single Action Controllers
    Route::get('address/{address}/contacts', 'GetContactsByAddress');
    Route::get('address/{address}/dues', 'GetDuesByAddress');
    Route::get('email-list', 'GetEmailList');
    Route::post('assign-committee/{contact}', 'AssignContactToCommittee');

    // Resourceful Controllers

    Route::apiResource('contacts', 'ContactController');
    Route::apiResource('committees', 'CommitteeController');
    Route::apiResource('users', 'UserController');
});

