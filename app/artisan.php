<?php
	require __DIR__ . "/vendor/autoload.php";

	use App\Services\Console;
	use App\Services\CmdColor;
	use App\Services\Command;

	Console::WriteLine("################################################################################", CmdColor::RED);
	Console::WriteLine("#                                Andph world                                   #", CmdColor::RED);
	Console::WriteLine("################################################################################", CmdColor::RED);
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

	Console::Set(CmdColor::RESET_ALL);