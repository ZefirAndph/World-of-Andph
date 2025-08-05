<?php

	declare(strict_types=1);

	namespace App\Services;

	class RestApi
	{
		private object $m_request;
		private Services $m_service;
		public function __construct($request)
		{
			$this->m_service = Services::BuildContainer();
			$this->m_request = $request;
		}

		public function Response(): string
		{
			$respond = $this->m_request;
			return json_encode();
		}
	}