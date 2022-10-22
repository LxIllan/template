<?php

class Util 
{
	public const API_URL = 'https://slim.damsoluciones.com/';
	public const FOOTER = 'Copyright © Template 2022';
	public const APP_NAME = 'Template';

	/**
	 * @param string $jwt
	 * @return stdClass
	 */
	public static function decode_jwt(string $jwt): stdClass
	{
		return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $jwt)[1]))));
	}

	/**
	 * @param array $items
	 * @return bool
	 */
	public static function isArrayOfFloats(array $items): bool
	{
		foreach ($items as $item) {
			if (!is_numeric($item)) {
				return false;
			}
		}
		return true;
	}
}