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
			$obj = ($wl->GetAllData());
			Console::WriteLine($obj->World->name);
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
			
		}
	}