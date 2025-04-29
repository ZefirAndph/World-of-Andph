<?php

	declare(strict_types=1);

	namespace App\Services;

	class WorldLoader
	{
		private string $m_dir;
		public function __construct(string $basePath = null)
		{
			$this->m_dir = $basePath ?? __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
			echo $this->m_dir;
		}
	}