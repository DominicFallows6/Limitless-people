<?php

Route::group(['middleware' => ['auth', 'powhrUser']], function() {
	Route::controller('powhruser', '\Powhr\Controllers\SuperUsers\Home');
});

Route::group(['middleware' => ['auth', 'admin']], function () {

	//special one off based
	Route::controller('admin_dashboard', '\Powhr\Controllers\Admin\AdminController');

	Route::get('admin/{namespace?}/{controller?}/{method?}/{args?}', function ($namespace, $controller, $method = 'index', $args = '') {

		//convert from slightly nicer URLs
		$namespace = studly_case($namespace);
		$controller = studly_case($controller);
		$method = studly_case($method);

		$app = app();
		$controllerCall = $app->make('\Powhr\Modules\\'.$namespace.'\Controllers\\'.$controller);

		return $controllerCall->callAction('get'.$method, array($args));

	});
	Route::post('admin/{namespace?}/{controller?}/{method?}/{args?}', function ($namespace, $controller, $method = 'index', $args = '') {
		//convert from slightly nicer URLs
		$namespace = studly_case($namespace);
		$controller = studly_case($controller);
		$method = studly_case($method);

		$app = app();
		$controllerCall = $app->make('\Powhr\Modules\\'.$namespace.'\Controllers\\'.$controller);

		return $controllerCall->callAction('post'.$method, array($args));

	});

});

Route::group(['middleware' => 'auth'], function () {

	Route::controller('dashboard', '\Powhr\Controllers\DashboardController');
	Route::controller('ideas', '\Powhr\Modules\Ideas\Controllers\IdeasController');
	Route::controller('room-booking', '\Powhr\Modules\RoomBooking\Controllers\RoomBookingController');
	Route::controller('users', '\Powhr\Controllers\UserController');
	Route::controller('organisation_units', '\Powhr\Controllers\OrganisationUnitsController');
	Route::controller('organisation_units_admin', '\Powhr\Controllers\Admin\OrganistationUnitsController');
	Route::controller('users_admin', '\Powhr\Controllers\Admin\UserController');
	Route::controller('attendance', '\Powhr\Modules\HolidayRequests\Controllers\HolidayRequestController');
	Route::controller('announcements', '\Powhr\Modules\BusinessAnnouncements\Controllers\BusinessAnnouncements');
	Route::controller('staff-docs', '\Powhr\Modules\StaffDocs\Controllers\StaffDocs');

});

/**
 * All other public routes
 */

//todo remove this once live or move to an admin function
Route::get('/importer',  function(){

	if ($file = fopen(storage_path().'/cache/warehouse.csv', 'r')) {

		while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {

			$user = new \Powhr\Models\User();
			$user->username = strtolower($data[2]);
			$user->email = strtolower($data[2]);
			$user->password = \Hash::make('welcome15');
			$user->first_name = ucwords(strtolower($data[1]));
			$user->surname = ucwords(strtolower($data[0]));
			$user->superior_id = 19;
			$user->bonus_days = 0;
			$user->organisation_unit_id = 12;
			$user->save();

            echo $user->id;
            echo '<br />';
			unset($user);

		}

	}

});

//todo remove this once live or move to an admin function
//todo remove this once live or move to an admin function
Route::get('importer-holidays', function(){

	//echo strtotime('25/05/2016');

	//$date = DateTime::createFromFormat('d/m/Y', '25/05/2016');
	//print_r($date);

	$current = 0;
	$pathToFile = storage_path().'/cache/customer_experience_two.csv';

	if ($file = fopen($pathToFile, 'r')) {

		while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {

			$date =  DateTime::createFromFormat('d/m/Y', $data[1]);

			$hrg = new \Powhr\Modules\HolidayRequests\Models\HolidayRequestGroups();
			$hrg->start = $date->format('Y-m-d');
			$hrg->end = $date->format('Y-m-d');
			$hrg->user_id = $data[0];
			$hrg->one_off = 1;
			$hrg->duration_type = $data[2];
			$hrg->awaiting_auth = $data[0];
			$hrg->day_count = 1;

			if (!empty($data[3])) {
				$hrg->holiday_request_type_id = 1;
			}

			$hrg->save();

			$hr = new \Powhr\Modules\HolidayRequests\Models\HolidayRequestsInterface();
			$hr->requested_date = $date->format('Y-m-d');
			$hr->user_id = $data[0];
			$hr->holiday_request_group_id = $hrg->id;
			$hr->authorised_by = $data[0];
			$hr->duration = $data[2];

			$hr->save();

		}

		echo $pathToFile. ' imported';

	}

});


Route::post('room-booking-admin/add-room', '\Powhr\Modules\RoomBooking\Controllers\RoomBookingAdmin@postAddRoom');
Route::post('room-booking-admin/delete-room', '\Powhr\Modules\RoomBooking\Controllers\RoomBookingAdmin@postDeleteRoom');
Route::post('room-booking-admin/edit-room', '\Powhr\Modules\RoomBooking\Controllers\RoomBookingAdmin@postEditRoom');
Route::post('room-booking-admin/add-building', '\Powhr\Modules\RoomBooking\Controllers\RoomBookingAdmin@postAddBuilding');
Route::post('room-booking-admin/delete-building', '\Powhr\Modules\RoomBooking\Controllers\RoomBookingAdmin@postDeleteBuilding');
Route::post('room-booking-admin/edit-building', '\Powhr\Modules\RoomBooking\Controllers\RoomBookingAdmin@postEditBuilding');

// Password reset link request routes... Laravel Provided
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/', '\Powhr\Controllers\HomeController@showWelcome');
Route::controller('account', '\Powhr\Controllers\Account');

//Old route for bookmarks!! :/
Route::get('/home', function(){
	return redirect('/dashboard');
});

//Route::get('/james', function(){
//
//    $input = [
//        'name' => 'James Firminger',
//        'email' => 'james.firminger@gmail.com',
//        'comment' =>  'Testing queues',
//        'subject' =>  'Email subject'
//    ];
//
//    Mail::queueOn('email-queue', 'emails.contact', ['input'=>$input], function($message) use ($input) {
//        $message->to($input['email'], $input['name']);
//        $message->subject($input['subject']);
//    });
//
//});
//
//Route::get('queue', function(){
//    Queue::push('Myapp\Queue\PhotoService', array('image_path' => '/path/to/image/file.ext'));
//});