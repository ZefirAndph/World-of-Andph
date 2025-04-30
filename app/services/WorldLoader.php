<?php

	declare(strict_types=1);

	namespace App\Services;

	use Symfony\Component\Yaml\Yaml;
	use App\Services\Tools;

	const DS = DIRECTORY_SEPARATOR;

	class WorldLoader implements IService
	{
		private string $m_dir;
		public function __construct(string $basePath = null)
		{
			$this->m_dir = $basePath ?? __DIR__ . DS . ".." . DS . "..";
		}

		public function GetRootPath(): string
		{
			return $this->m_dir;
		}

		public function GetAllData(): object
		{
			return $this->loadWorld();
		}

		public function GetSpecies(): array
		{
			$data = $this->loadWorld();
			return $data->Species;
		}

		// Internal functions
		private function loadWorld(): object
		{
			$objWorld = new \stdClass;
			$worldFile = $this->m_dir . DS . "world.yml";
			if(file_exists($worldFile))
				$objWorld->World = Tools::ArrToObj(Yaml::parse(file_get_contents($worldFile)));

			$objWorld->Gods = [];
			$objWorld->Herbals = [];
			$objWorld->Species = [];

			foreach($this->listFiles($this->m_dir) as $file)
			{
				$path = substr($file, strlen($this->m_dir));
				if($file == $worldFile)
					continue;

				$data = Tools::ArrToObj(Yaml::parse(file_get_contents($file)));

				$node = strtolower($data->class ?? $data->entita ?? "unk");

				switch($node)
				{
					case "god":
					case "bůh":
						$objWorld->Gods[] = $data;
						break;
					case "herbal":
						$objWorld->Herbals[] = $data;
						break;
					case "specie":
						$objWorld->Species[] = $data;
						break;
					case "unk":
						$objWorld->Errors[] = "File without defined type: $path";
						break;
					default:
						$objWorld->Errors[] = "Unknown node type: $node in file $path";
						break;
				}
			}

			return $objWorld;
		}

		private function listFiles(string $basePath, bool $nested = false): array
		{
			$retv = [];
			foreach(scandir($basePath) as $file)
			{
				if(in_array($file, ['.', '..', '.git', 'app', 'templates']))
					continue;

				$path = $basePath . DS . $file;

				if (is_dir($path)) 
				{
					if($nested)
						$retv[] = $this->listFiles($path);
					else
						$retv = array_merge($retv, $this->listFiles($path));
				}
				elseif (is_file($path)) 
				{
					if(in_array(substr($path, -4), ['yaml', '.yml']))
						$retv[] = $path;
				}
				else
				{
					// error state
				}
				
			}
			return $retv;
		}
	}