<?php


Route::get('/',function(){
	return view('index');
})->name('index');


Route::post('/submit', function(\Illuminate\Http\Request $request){
	$content = $request['content'];
	return view('output',['content'=> $content]);
})->name('submit');

/*Route::resource('financialReport','financialController',
	['middleware' => ['roles'],
	 'roles' => ['Admin'],
	]);*/

Route::group(['middleware' => ['web']], function(){
	Route::resource('comment', 'CommentsController',['except'=> ['create']]);
	
	Route::get('/comment/{id}/edit', [
		'uses'=>'CommentsController@edit',
		'as'=>'comment.edit',
	]);

	Route::put('/comment/{id}/update', [
		'uses'=>'CommentsController@update',
		'as'=>'comment.update',
	]);

	Route::post('/comment/{posts_id}/store', [
		'uses' => 'CommentsController@store',
		'as' =>'comment.store',
		'middleware'=>'roles'
	]);


});



Auth::routes();

Route::post('/createpost',[
'uses' => 'PostController@postCreatePost',
'as' =>'post.create'
]);

Route::get('/delete-post/{post_id}', [
'uses' => 'PostController@getDeletePost',
'as' =>'post.delete',
'middleware'=>'roles'
// 'roles' => ['Admin','Author','Users']
]);
Route::post('/edit',[
	'uses' => 'PostController@postEditPost',
	'as' => 'edit'
	]);


///////// for new post style ///////

Route::get('post/{id}/editPost',
		['uses' => 'PostController@editPost',
		 'as' => 'PostControllerEditPost',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

Route::put('post/{id}/updatePost',[
	'uses' => 'PostController@updatePost',
	'as' => 'updatePost',
	'middleware'=>'roles',
	'roles' => ['Admin','District Secretary'],
	]);
///////// end for new post style ///////

Route::get('/home', [
'uses' => 'PostController@getDashboard',
'as' =>'dashboard',
'middleware'=>'roles'
// 'roles' => ['Admin','Author','Users']
]);

Route::post('/like', [
'uses' => 'PostController@postLikePost',
'as' =>'like'
]);

Route::get('/account', [
'uses' => 'UsersController@getAccount',
'as' =>'account',
'middleware'=>'roles'
]);

Route::post('/updateaccount', [
'uses' => 'UsersController@PostSaveAccount',
'as' =>'account.save'
]);

Route::get('/userimage/{filename}', [
'uses' => 'usersController@getUserImage',
'as' =>'account.image',
'middleware'=>'roles'
]);

Route::get('/postimage/{filename}', [
'uses' => 'PostController@getPostImage',
'as' =>'post.image',
'middleware'=>'roles'
]);

/// end of post controller




Route::resource('users','usersController',
	['middleware'=> ['roles'],	
	]);

Route::resource('roles','rolesController',
	['middleware' => ['roles'],
	 
	]);

Route::resource('lodge','lodgeController',
	[
	 'roles' => ['Admin']
	]);

Route::get('/lodge/{filename}', [
'uses' => 'lodgeController@getLodgeLogo',
'as' =>'lodge.logo',
'middleware'=>'roles'
]);

// calendar start //
Route::resource('calendarEvents','calendarEventController');

Route::get('calendarEvents/getResponse/{id}', [
'uses' => 'calendarEventController@getResponse',
'as' =>'event.Response',
'middleware'=>'roles'
]);

Route::put('calendarEvents/actionResponse/{id}', [
'uses' => 'calendarEventController@actionResponse',
'as' =>'action.Response',
'middleware'=>'roles'
]);

Route::post('/response', [
'uses' => 'calendarEventController@eventResponseEvent',
'as' =>'response'
]);

// end of calendar event

Route::prefix('financialReport')->group(function(){

	Route::get('/OfinanR',
	['uses' => 'financialController@oindex',
	 'as' => 'finanOfficialIndex',
	 'middleware'=>'roles',
	 'roles' => ['Admin','District Secretary'],
	]);

	Route::get('/ocreate', // link in browser
		['uses' => 'financialController@ocreate',
		 'as' => 'finanReportoCreate',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::post('/ostore',
		['uses' => 'financialController@ostore',
		 'as' => 'finanReportUStore',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/uocreate', // link in browser
	['uses' => 'financialController@uocreate',
	 'as' => 'finanReportUoCreate',
	 'middleware'=>'roles',
	 'roles' => ['Admin','District Secretary'],
	]);

	Route::post('/uostore',
		['uses' => 'financialController@uostore',
		 'as' => 'finanReportUoStore',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/UofinanR',
	['uses' => 'financialController@uoindex',
	 'as' => 'finanUoIndex',
	 'middleware'=>'roles',
	 'roles' => ['Admin','District Secretary'],
	]);

	Route::get('/{id}/edit',
		['uses' => 'financialController@edit',
		 'as' => 'financialControllerEdit',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::put('/{id}/update',
		['uses' => 'financialController@update',
		 'as' => 'financialControllerUpdate',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/{id}/show',
		['uses' => 'financialController@show',
		 'as' => 'finanReportShow',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/{id}/pdf',
		['uses' => 'financialController@pdf',
		 'as' => 'financialControllerPDF',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],

		])->name('pdf');

	Route::post('/{id}/delete',
		['uses' => 'financialController@deleteUo',
		 'as' => 'financialDeleteUo',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);
	Route::post('/{id}/archive',
		['uses' => 'financialController@archive',
		 'as' => 'finanncialSoftDelete',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/trashes',
		['uses' => 'financialController@trashes',
		 'as' => 'financialTrash',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/{id}/restore',
		['uses' => 'financialController@restore',
		 'as' => 'restoreone',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/restoreall',
		['uses' => 'financialController@restoreall',
		 'as' => 'restoreAllFReport',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);
});

//////////////// END OF FINANCIAL REPORT ROUTES /////////////

/////////////// MEETING REPORT ROUTES ///////////
/**/

Route::prefix('meeting')->group(function(){

	Route::get('/',
	['uses' => 'meetingController@uoindex',
	 'as' => 'meetingController',
	 'middleware'=>'roles',
	 'roles' => ['Admin','District Secretary'],
	]);

	Route::get('/meetingor',
	['uses' => 'meetingController@indexmeetingOr',
	 'as' => 'meetingControllerOr',
	 'middleware'=>'roles',
	 'roles' => ['Admin','District Secretary'],
	]);

	Route::get('/Uocreate',
		['uses' => 'meetingController@uocreate',
		 'as' => 'meetingControllerUoCreate',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/officialcreate',
		['uses' => 'meetingController@officialcreate',
		 'as' => 'meetingControllerOfficialCreate',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::post('/uostore',
		['uses' => 'meetingController@uostore',
		 'as' => 'meetingControllerUoStore',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::post('/officialstore',
		['uses' => 'meetingController@officialstore',
		 'as' => 'meetingControllerOfficialStore',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/{id}/edit',
		['uses' => 'meetingController@edit',
		 'as' => 'meetingControllerEdit',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::put('/{id}/update',
		['uses' => 'meetingController@update',
		 'as' => 'meetingControllerUpdate',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/{id}/show',
		['uses' => 'meetingController@show',
		 'as' => 'meetingControllerShow',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/{id}/showSoftDelete',
		['uses' => 'meetingController@showSoftDelete',
		 'as' => 'meetingControllerShowSoftDelete',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::post('/{id}/archive',
		['uses' => 'meetingController@archive',
		 'as' => 'meetingSoftDelete',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::post('/{id}/delete',
		['uses' => 'meetingController@deleteUo',
		 'as' => 'meetingDeleteUo',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/trashes',
		['uses' => 'meetingController@trashes',
		 'as' => 'meetingTrashed',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/restoreall',
		['uses' => 'meetingController@restoreall',
		 'as' => 'restoreAllMeetingReports',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::get('/{id}/restore',
		['uses' => 'meetingController@restore',
		 'as' => 'restoreone',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);

	Route::delete('/{id}/delete',
		['uses' => 'meetingController@destroy',
		 'as' => 'deletePermanent',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],
		]);


	Route::get('/{id}/pdf',
		['uses' => 'meetingController@pdf',
		 'as' => 'meetingControllerPDF',
		 'middleware'=>'roles',
		 'roles' => ['Admin','District Secretary'],

		])->name('pdf');
	
});



/////////// END OF MEETING REPORT ROUTES ////////



