<?php

	declare(strict_types=1);

	namespace App\Services;

	class Tools
	{
		public static function IsExist(...$args): bool
		{
			foreach($args as $arg)
			{
				if(isset($arg))
					return true;
			}
			return false;
		}

		public static function Exist(...$args): mixed
		{
			foreach($args as $arg)
			{
				if(isset($arg))
					return $arg;
			}
			return null;
		}

		public static function IsNotNull(...$args): bool
		{
			foreach($args as $arg)
			{
				if(isset($arg) && !empty($arg))
					return true;
			}
			return false;
		}

		public static function NotNull(...$args): mixed
		{
			foreach($args as $arg)
			{
				if(isset($arg) && !empty($arg))
					return $arg;
			}
			return null;
		}

		public static function ArrToObj(array $arr): object
		{
			$js = json_encode($arr);
			return json_decode($js);
		}
	}