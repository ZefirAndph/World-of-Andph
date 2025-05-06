<?php

	declare(strict_types=1);

	namespace App\Services;

	use Symfony\Component\Yaml\Yaml;
	use App\Services\Tools;

	const DS = DIRECTORY_SEPARATOR;

	class WorldLoader implements IService
	{
		private string $m_dir;
		public function __construct(string | null $basePath = null)
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

		public function BuildTimeline(): array
		{
			$data = [];
			$this->nodeLocator($data,"history", $this->loadWorld());
			$timeline = [];
			foreach($data as $historyNode)
			{
				foreach($historyNode as $event)
				{
					if(!isset($timeline[$event->year]))
						$timeline[$event->year] = [];
						
					$timeline[$event->year][] = $event->desc;
				}
			}

			uksort($timeline, function($a, $b) 
			{
				// Rozparsování klíče
				if(preg_match('/^(.+) E(\d+)$/', $a, $ma) 
				&& preg_match('/^(.+) E(\d+)$/', $b, $mb))
				{
					$a_era = intval($ma[2]);
					$b_era = intval($mb[2]);

					$a_year = intval($ma[1]);
					$b_year = intval($mb[1]);

					if ($a_era !== $b_era)
						return $a_era <=> $b_era;
					
					return $a_year <=> $b_year;
				}
				return true;
			});

			return $timeline;
		}

		public function GodsList(): array
		{
			$data = [];
			$this->classLocator($data,"god", $this->loadWorld()->Entities);
			$retv = [];
			foreach($data as $god)
			{
				$retv[] = $god;
			}

			return $retv;
		}

		public function GetEntity(string $name, null|string $class = null): object|null
		{
			$data = $this->loadWorld();
			foreach($data->Entities as $ent)
			{
				if(isset($ent->name) && $ent->name == $name)
				{
					if(!isset($class))
						return $ent;

					if($ent->class == $class)
						return $ent;
				}
			}
			return null;
		}

		public function GetEntityByClass(string $className): array
		{
			$data = $this->loadWorld();
			$retv = [];
			foreach($data->Entities as $ent)
			{
				if($ent->class == $className)
					$retv[] = $ent;
			}
			return $retv;
		}

		// Internal functions
		private function loadWorld(): object
		{
			$objWorld = new \stdClass;
			$worldFile = $this->m_dir . DS . "world.yml";
			if(file_exists($worldFile))
				$objWorld->World = Tools::ArrToObj(Yaml::parse(file_get_contents($worldFile)));

			// $objWorld->Gods = [];
			// $objWorld->Herbals = [];
			//$objWorld->Species = [];
			$objWorld->Other = [];
			$objWorld->Entities = [];

			foreach($this->listFiles($this->m_dir) as $file)
			{
				$path = substr($file, strlen($this->m_dir));
				if($file == $worldFile)
					continue;

				$data = Tools::ArrToObj(Yaml::parse(file_get_contents($file)));

				$node = strtolower($data->class ?? $data->entita ?? "unk");

				switch($node)
				{
					case "unk":
						$objWorld->Other[] = $data;
						$objWorld->Errors[] = "File without defined node type: $path";
						break;
					default:
						$objWorld->Entities[] = $data;	
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

		private function nodeLocator(array &$retv, string $nodeName, object|array $startPoint): void
		{
			foreach($startPoint as $key => $value)
			{
				if($key == $nodeName)
					$retv[] = $value;
				else if(is_array($value))
					$this->nodeLocator($retv, $nodeName, $value);
				else if(is_object($value))
					$this->nodeLocator($retv, $nodeName, $value);
			}
		}

		private function classLocator(array &$retv, string $className, object|array $parentGroup): void
		{
			foreach($parentGroup as $key => $val)
			{
				if(isset($val->class) && $val->class == $className)
					$retv[] = $val;
			}

			uksort($retv, function($a, $b) 
			{
				if($a->tier !== $b->tier)
					return $a->tier <=> $b->tier;

				return $a->name <=> $b->name;
			});
		}
	}