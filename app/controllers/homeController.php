<?php
/**
 * Created by PhpStorm.
 * User: raymondkiekens
 * Date: 11/06/14
 * Time: 20:55 PM
 */

class HomeController extends BaseController
{

	function __construct(){
		parent::__construct();
		$this->addData('section', 'home');
	}

	public function indexAction()
	{

		return View::make("home/index", $this->data);
	}

} 