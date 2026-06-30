<?php
	require __DIR__ . "/vendor/autoload.php";

	use App\Services\Console;
	use App\Services\CmdColor;
	use App\Services\Command;
	////////////////////////////////////////////////////////////////// Tajtok je polovina
	Console::WriteLine("################################################################################", CmdColor::GREEN);
	Console::WriteLine("#                          Andph World - Initializing                          #", CmdColor::GREEN);
	Console::WriteLine("################################################################################", CmdColor::GREEN);
	Console::WriteLine("");
	switch($argc)
	{
		case 1:
			do {Console::Set(CmdColor::GREEN);}
			while (Command::Run(Console::ReadLine("$ ")));
			break;
		default:
			array_shift($argv);
			Command::Run(implode(" ", $argv));
			break;
	}
	Console::WriteLine("\r\nAndph World terminating...");
	
	Console::Set(CmdColor::RESET_ALL);