<?php
/**
 * Created by PhpStorm.
 * User: raymondkiekens
 * Date: 11/06/14
 * Time: 21:41 PM
 */

class CalendarEvent extends \Eloquent
{

	protected $table = 'events';

	protected $fillable = array('title', 'subtitle', 'info', 'start', 'end');

	protected $guarded = array('id');
} 