<?php

/* Verification Emails Routes */
Route::prefix('p')->namespace('\ProgrammitControllers')->group(function () {
	Route::prefix('secure')->group(function () {
		Route::prefix('verification')->group(function () {
			Route::get('account/confirmed','ProgrammitEmailVerificationController@confirmed_account_email');
			Route::get('account/{email_verification_token}','ProgrammitEmailVerificationController@email_verification');
		});
	});
});