<?php

namespace Powhr\Modules\BusinessAnnouncements\Controllers;
use \Powhr\Modules\BusinessAnnouncements\Models\InterfaceBusinessAnnouncements;

class BusinessAnnouncements extends \Powhr\Modules\Module {

	protected $url = 'announcements';
	protected $ba;
	protected $request;

	/**
	 * BusinessAnnouncements constructor.
	 * @param InterfaceBusinessAnnouncements $ba
	 * @param \Illuminate\Http\Request $request
	 */
	function __construct (
		\Powhr\Modules\BusinessAnnouncements\Models\InterfaceBusinessAnnouncements $ba, 
		\Illuminate\Http\Request $request
	)
	{
		$this->ba = $ba;
		$this->request = $request;
		parent::__construct();
	}

	function getIndex() {
		echo ($this->ba->getAllAnnouncements($this->request->user()->organisationUnit->business_id));
	}
	
	function setConfig()
	{
		// TODO: Implement setConfig() method.
	}

	function getEdit()
	{
		
	}

}