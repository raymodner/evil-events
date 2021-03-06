<?php
/**
 * Created by PhpStorm.
 * User: raymondkiekens
 * Date: 11/06/14
 * Time: 21:35 PM
 */

class ContactController extends BaseController
{

	function __construct(){
		parent::__construct();
		$this->addData('section', 'contact');
	}


	public function indexAction()
	{
		return View::make("contact/index", $this->data);
	}


	public function addAction()
	{
		$contact = new Contact();
		if (Input::server("REQUEST_METHOD") == "POST") {
			$post = array('email' => Input::get('email'),
						  'message' => Input::get('message'),
						  'event_id' => Input::get('event_id'),
						  );

			$validator = Validator::make($post, array(
				"email" => "required|email",
				"message"  => "required",

			));
			$contact->fill($post);
			$this->addData('contact', $contact);

			if ($validator->passes()) {
				$contact->save();

				Mail::send('email.contact', $this->data, function($message)
				{
					$message->from('info@evil-events.nl');
					$message->to('raymond@oberon.nl')->subject('Contact aanvraag');
				});

				return Response::json(array('success' => 'true', 'message' => 'Bericht verstuurd'));
			}

			$this->addData('errors', $validator->messages());
			$view =  View::make('contact/add', $this->data)->render();
			$this->addData('view', $view);
			return Response::json($this->data);
		}
		$this->addData('contact', $contact);
		return View::make('contact/add', $this->data);
	}


} 