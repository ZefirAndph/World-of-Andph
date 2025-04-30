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
	}