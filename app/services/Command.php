<?php

	declare(strict_types=1);
	namespace App\Services;

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
			];

			$this->m_command = $cmd;
		}

		public function Execute(): void
		{
			$handled = false;
			foreach($this->m_knownCommands as $command => $callback)
			{
				if(strpos($this->m_command . ' ', $command. ' ') === 0)
				{
					Console::Set(CmdColor::YELLOW);
					call_user_func($callback, explode(" ", substr($this->m_command, strlen($command)+1)));
					$handled = true;
				}
			}

			if(!$handled)
			{
				Console::WriteLine("Uknown command. Try 'help'.", CmdColor::RED);
			}
		}

		public function CanContinue(): bool
		{
			return !$this->m_terminate;
		}
		
		// Commands
		private function CmdHelp(array $args): void
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

		private function Exit(array $args): void 
		{
			$this->m_terminate = true;
		}

		private function Test(array $args): void 
		{
			$world = new \App\Services\WorldLoader();
		}
	}