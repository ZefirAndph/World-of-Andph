<?php

	declare(strict_types=1);

	const SOURCES = "..";

	$files = [];
	
	function ScandirRecurse(string $path, bool $nested = true): array
	{
		$retval = [];
		foreach(scandir($path) as $e)
		{
			if(in_array($e, [".", "..", ".git"])) 
				continue;

			$actual_path = $path . DIRECTORY_SEPARATOR . $e;

			if(is_dir($actual_path))
			{
				if($nested)
					$retval[] = ScandirRecurse($actual_path, $nested);
				else
					$retval = array_merge($retval, ScandirRecurse($actual_path, $nested));
			}
			else
				$retval[] = $actual_path;
		}
		return $retval;
	}

	function yamlParse(string $content): object
	{
		$lines = explode(PHP_EOL, $content);
		$obj = (object)[];
		foreach($lines as $line)
		{
			$deep = floor(strspn($line, ' ') / 2);
			// take one and read unti deep nezačne stoupat
			dump($deep, true);
		}
		return $obj;
	}

	function dump(mixed $obj, bool $raw = false): void
	{
		$out = print_r($obj, true);
		if($raw)
			echo($out . PHP_EOL);
		else
			echo("```" . PHP_EOL . $out . PHP_EOL . "```" . PHP_EOL);
	}
	
	//dump(ScandirRecurse(SOURCES, true));
	dump(yamlParse(file_get_contents("..\\rasy\\elfove.yml")));