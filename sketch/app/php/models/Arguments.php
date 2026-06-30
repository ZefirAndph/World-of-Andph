<?php
	declare(strict_types=1);

	namespace App\Models;

	class Arguments
	{
		private string $m_args;
		public function __construct(string|array $in)
		{
			if(is_array($in))
			{
				$this->m_args = implode(" ", $in);
			}
			else if(is_string($in))
			{
				$this->m_args = $in;
			}
		}

		public function Has(string $str): bool
		{
			return strpos($this->m_args, $str) !== false;
		}

		public function Get(int|string $idx = 0): string|null
		{
			if(is_numeric($idx))
			{
				$data = explode(' ', $this->m_args);
				return isset($data[$idx]) ? $data[$idx] : null;
			}

			if(is_string($idx))
			{
				$data = explode(' ', $this->m_args);
				for($i = 0; $i < count($data); $i++)
				{
					if($data[$i] == $idx)
						return isset($data[$i+1]) ? $data[$i+1] : null;
				}
			}

			return null;
		}
	}