<?php

namespace Powhr\Controllers;

//acts purely as a redirect
//maybe able to move using middleware

class HomeController extends \App\Http\Controllers\Controller {

	function __construct() {
		$this->middleware('auth');
	}

	public function showWelcome()
	{

        if (\Auth::check()) {
            return \Redirect::to('dashboard');
        } else {
			return \Redirect::to('account/login');
		}

	}

}
