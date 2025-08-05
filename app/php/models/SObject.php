<?php

	declare(strict_types=1);

	namespace App\Models;

	use App\Services\Tools;

	class SObject
	{
		
		private object $m_data;
		public function __construct(object $source)
		{
			$this->m_data = $this->wrapObject($source);
		}
		
		public function __toString(): string
		{
			return "unk";
		}

		/**
		 * Je to hezké, ale nevrací to hodnoty... jen SObject bez hodnot.
		 */
		public function __get(string $key): mixed
		{
			if (!property_exists($this->m_data, $key)) 
			{
				return new self((object)[]);
			}

			return $this->m_data->$key;
		}
		public function __set(string $key, $value): void
		{
			$this->m_data->$key = $value;
		}
	
		public function __isset(string $key): bool
		{
			return isset($this->m_data->$key);
		}
	
		public function __unset(string $key): void
		{
			unset($this->m_data->$key);
		}

		private function wrapObject(object $obj): object
		{
			if (is_array($obj)) {
				$obj = Tools::ArrToObj($obj);
			}

			foreach (get_object_vars($obj) as $key => $val) {
				if (is_object($val) && get_class($val) === 'stdClass') {
					$obj->$key = new self($this->wrapObject($val));
				}
			}
			return $obj;
		}
	}