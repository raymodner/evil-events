<?php
/**
 * Created by PhpStorm.
 * User: raymondkiekens
 * Date: 14/06/14
 * Time: 19:23 PM
 */

class ReportController extends BaseController
{

	function __construct(){
		parent::__construct();
		$this->addData('section', 'report');
	}


	public function indexAction()
	{
		return View::make("report/index", $this->data);
	}


} 