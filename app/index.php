<?php

	ConsoleWrite("Bububu", CmdColor::RED);
	while(true)
	{
		$command = readline("> ");

		echo $command . PHP_EOL;
	}


	enum CmdColor : int
	{
		case BLACK = 0;
		case RED = 31;
	};
	
	function ConsoleWrite(string $text, CmdColor $color)
	{
		echo "\e[39" . $text . "\e[0";
	}
/*
	# Text Colors           Code
	# ---------------------------
	# Black                 0;30
	# White                 1;37
	# Dark Grey             1;30
	# Red                   0;31
	# Green                 0;32
	# Brown                 0;33
	# Yellow                1;33
	# Blue                  0;34
	# Magenta               0;35
	# Cyan                  0;36
	# Light Cyan            1;36
	# Light Grey            0;37
	# Light Red             1;31
	# Light Green           1;32
	# Light Blue            1;34
	# Light Magenta         1;35

	# Background Colors     Code
	# ---------------------------
	# Black                 40
	# Red                   41
	# Green                 42
	# Yellow                43
	# Blue                  44
	# Magenta               45
	# Cyan                  46
# Light Grey            47
*/