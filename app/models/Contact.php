<?php

class Contact extends Eloquent
{


	public function event() {
		return $this->belongsTo('CalendarEvent', 'event_id');
	}

	protected $fillable = array('email', 'message', 'event_id');

	protected $guarded = array('id');

}
