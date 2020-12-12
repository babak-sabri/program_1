<?php
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserDetailsController;
/*
|--------------------------------------------------------------------------
| User routes
|--------------------------------------------------------------------------
|
|
*/
Route::prefix('user')->group(function () {
	//Get active Austrian user list
	Route::get('/', [UserController::class, 'index'])
		->name('user.list')
		;
	
	//Delete a user
	Route::delete('/{user}', [UserController::class, 'destroy'])
		->middleware('check_user_details')
		->where('user', '[0-9]+') // user id
		->name('user.delete')
		;
	
	//Update user details
	Route::put('/{userDetail}/details', [UserDetailsController::class, 'update'])
		->where('userDetail', '[0-9]+') // bind UserDetail based on the user id
		->name('update.user.details')
		;
});