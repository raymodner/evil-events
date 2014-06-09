<?php

/**
 * Description of StringTools
 * @version 1.0
 * @author chin
 * @copyright (c) Oberon Interactive 2013
 */
class StringTools {

	public static function toAscii($str, $delimiter = '-') {
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}

}