<?php

	declare(strict_types=1);
	namespace App\Services;

	use App\Models\Arguments;
	use App\Models\SObject;

	class Command
	{
		// statické volání
		public static function Run(string $cmd): bool
		{
			$c = new Command($cmd);
			$c->Execute();
			return $c->CanContinue();
		}

		private string $m_command;
		private array $m_arguments;
		private array $m_knownCommands;
		private bool $m_terminate = false;
		private Services $m_service;
		public function __construct(string $cmd)
		{
			// Register known commands
			$this->m_knownCommands = [
				'help' => [$this, 'CmdHelp'],
				'exit' => [$this, 'Exit'],
				'x' => [$this, 'Exit'],
				'stop' => [$this, 'Exit'],
				'terminate' => [$this, 'Exit'],
				'vypni to' => [$this, 'Exit'],
				'test' => [$this, 'Test'],

				
				'timeline' => [$this, 'TimeLine'],
				
				//[$this, 'Gods']
				'gods' => [$this, 'Gods'],
				'god' => [$this, 'Gods'],
				
				//[$this, 'Characters']
				'char' => [$this, 'Characters'],
				'chars' => [$this, 'Characters'],
				'character' => [$this, 'Characters'],
				'characters' => [$this, 'Characters'],
				
				'get races list' => [$this, 'GetRacesList'],
			];

			$this->m_command = $cmd;

			$this->m_service = Services::BuildContainer();
		}

		public function Execute(): void
		{
			$handled = false;
			foreach($this->m_knownCommands as $command => $callback)
			{
				if(strpos($this->m_command . ' ', $command. ' ') === 0)
				{
					Console::Set(CmdColor::YELLOW);
					call_user_func($callback, new Arguments(substr($this->m_command, strlen($command)+1)));
					$handled = true;
				}
			}

			if(!$handled)
			{
				Console::WriteLine("Uknown command ({$this->m_command}). Try 'help'.", CmdColor::RED);
			}
		}

		public function CanContinue(): bool
		{
			return !$this->m_terminate;
		}
		
		// Commands
		private function CmdHelp(Arguments $args): void
		{
			Console::Set(CmdColor::YELLOW, CmdColor::BLINK, CmdColor::BOLD);
			Console::WriteLine("Actions: ");
			Console::WriteLine("  Exit application      Posible use of commands: x, exit, stop, vypni to");
			Console::WriteLine("Known commands: ");
			Console::WriteLine("  x         Exit application");
			Console::WriteLine("  exit      Exit application");
			Console::WriteLine("  stop      Exit application");
			Console::WriteLine("  vypni to  Exit application");
		}

		private function Exit(Arguments $args): void 
		{
			$this->m_terminate = true;
		}

		private function Test(Arguments $args): void 
		{
			$wl = $this->m_service->Get(WorldLoader::class);
			foreach($wl->GetAllData()->Errors as $err)
			{
				Console::WriteLine($err);
			}
		}

		private function GetRacesList(Arguments $args): void
		{
			$wl = $this->m_service->Get(WorldLoader::class);
			foreach($wl->GetSpecies() as $spec)
			{
				Console::WriteLine("- {$spec->name}");
				if($args->Has("cultures"))
					foreach($spec->cultures as $cult)
						Console::WriteLine("  - {$cult->name}" . ($args->Has("origin") ? " - {$cult->origin}" : "") );
			}
		}

		private function Timeline(Arguments $args): void
		{
			$wl = $this->m_service->Get(WorldLoader::class);
			Console::WriteLine(print_r($wl->BuildTimeline(), true));
		}

		private function Gods(Arguments $args): void
		{
			$wl = $this->m_service->Get(WorldLoader::class);
			
			$action = 0;
			if($args->Get(0) != null) // asump name
				$action = 1;
			if($args->Get("name") != null)
				$action = 1;

			switch($action)
			{
				case 0: // list characters
					break;
				case 1: // char details
					$name = $args->Get("name") ?? $args->Get(0);
					$ent = $wl->GetEntity($name, 'god');
					if($ent == null)
						Console::WriteLine("God with name $name not found.");
					else
						Console::WriteLine(print_r($ent));
					break;
			}
		}

		private function Characters(Arguments $args)
		{
			$wl = $this->m_service->Get(WorldLoader::class);
			
			$action = 0;
			if($args->Get(0) != null) // asump name
				$action = 1;
			if($args->Get("name") != null)
				$action = 1;

			switch($action)
			{
				case 0: // list characters
					
					break;
				case 1: // char details
					$name = $args->Get("name") ?? $args->Get(0);
					$ent = $wl->GetEntity($name, 'character');
					if($ent == null)
						Console::WriteLine("Character with name $name not found.");
					else
						Console::WriteLine(print_r($ent));
					break;
			}
		}
	}