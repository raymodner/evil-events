<?php
/**
 * Created by PhpStorm.
 * User: raymondkiekens
 * Date: 14/06/14
 * Time: 19:23 PM
 */

class EventController extends BaseController
{

	function __construct(){
		parent::__construct();
		$this->addData('section', 'event');
	}


	public function indexAction()
	{

		$events = CalendarEvent::where('end', '<', 'now')->orderBy('start')->get();
		$this->addData('events', $events);
		return View::make("event/index", $this->data);

	}


} 