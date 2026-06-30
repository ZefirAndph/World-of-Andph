<?php

	declare(strict_types=1);

	namespace App\Services;

	class Console
	{
		public static function WriteLine(mixed $text, ...$params): void
		{
			echo Console::prepare((string)$text, $params) . PHP_EOL;
		}

		public static function Write(mixed $text, ...$params): void
		{
			echo Console::prepare((string)$text, $params);
		}

		public static function Set(...$params): void
		{
			echo Console::makeParams($params);
		}

		public static function prepare(string $text, array $params): string
		{
			if(count($params) > 0)
				return Console::makeParams($params) . $text . "\e[0m";
			else
				return $text;
		}

		public static function makeParams(array $params): string
		{
			$p_temp = [];
			foreach($params as $par)
				$p_temp[] = $par->value;

			return "\e[" . implode(";", $p_temp) . "m";
		}

		public static function ReadLine(string $prompt = ""): string
		{
			return readline($prompt);
		}
	};

	enum CmdColor : int
	{
		case RESET_ALL = 0;
		case BOLD = 1;
		case DIM = 2;
		case UNDERLINE = 4;
		case BLINK = 5;
		case REVERSE = 7;
		case HIDDEN = 8;
		// foreground colors
		case DEFAULT = 39;	
		case BLACK = 30;	
		case RED = 31;	
		case GREEN = 32;	
		case YELLOW = 33;	
		case BLUE = 34;	
		case MAGENTA = 35;	
		case CYAN = 36;	
		case LIGHT_GRAY = 37;	
		case DARK_GRAY = 90;	
		case LIGHT_RED = 91;	
		case LIGHT_GREEN = 92;	
		case LIGHT_YELLOW = 93;	
		case LIGHT_BLUE = 94;	
		case LIGHT_MAGENTA = 95;	
		case LIGHT_CYAN = 96;	
		case WHITE = 97;	
		// background colors
		case BG_DEFAULT = 49;
		case BG_BLACK = 40;
		case BG_RED = 41;
		case BG_GREEN = 42;
		case BG_YELLOW = 43;
		case BG_BLUE = 44;
		case BG_MAGENTA = 45;
		case BG_CYAN = 46;
		case BG_LIGHT_GRAY = 47;
		case BG_DARK_GRAY = 100;
		case BG_LIGHT_RED = 101;
		case BG_LIGHT_GREEN = 102;
		case BG_LIGHT_YELLOW = 103;
		case BG_LIGHT_BLUE = 104;
		case BG_LIGHT_MAGENTA = 105;
		case BG_LIGHT_CYAN = 106;
		case BG_WHITE = 107;
	};