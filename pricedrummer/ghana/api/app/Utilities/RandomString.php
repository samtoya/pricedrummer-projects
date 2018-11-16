<?php

namespace App\Utilities;


class RandomString
{
	/**
	 * Random generated string.
	 * @var string
	 */
	protected static $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	/**
	 * A random string generator.
	 * @param string $length
	 *
	 * @return string
	 */
	public static function random_str($length)
	{
		$str = '';
		$max = mb_strlen(self::$keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= self::$keyspace[random_int(0, $max)];
		}
		return $str;
	}
}
