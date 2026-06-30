<?php

$text = <<<TEXT
---
nejaky: data
tady: mame
totok: taky
---
TEXT;

$preg = '/^---\s*\n(.*?)\n---/s';


    preg_match($preg, $text, $matchs);
    print_r($matchs);