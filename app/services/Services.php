<?php

	declare(strict_types=1);

	namespace App\Services;

	class Services
	{
		public static function BuildContainer(): Services
		{
			$s = new Services();
			$s->Register(new \App\Services\WorldLoader());
			return $s;
		}

		private array $m_services = [];
		public function Register(\App\Services\IService $service)
		{
			$this->m_services[$service::class] = $service;
		}

		public function Get(string $serviceClass): mixed
		{
			if(isset($this->m_services[$serviceClass]))
				return $this->m_services[$serviceClass];

			return null;
		}
	}