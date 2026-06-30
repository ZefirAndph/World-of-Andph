<?php
/**
 * prototype of mag negeration function
 */

declare(strict_types=1);
require __DIR__ . "/vendor/autoload.php";

use Symfony\Component\Yaml\Yaml;
const ROOT = "..";

class WorldDocument {
    private string $m_content;
    private string $m_header;
    private string $m_raw;
    public function __construct($raw) {
        $this->m_raw = $raw;
        $this->parseDocument();
    }

    public static function Load(string $id): WorldDocument | null {
        if(DIRECTORY_SEPARATOR != "/")
            $id = str_replace("/", DIRECTORY_SEPARATOR, $id);

        $path = ROOT . DIRECTORY_SEPARATOR . $id .  ".md";

        if(!file_exists($path))
            throw new Exception("WorldDocument ($id) doesnt exists on path ($path).");
        
        return new WorldDocument(file_get_contents($path));
    }

    public function getContent() {
        if(isset($this->m_content) && $this->m_content != null)
            return $this->m_content;
        return null;
    }

    public function getHeader() {
        if(isset($this->m_header) && $this->m_header != null)
            return $this->m_header;
        return null;
    }

    private function parseDocument() {
        $matches = [];
        if (preg_match('/^---\s*\n(.*?)\n---/s', $this->m_raw, $matches)) {
            $this->m_header = $matches[1];
            $this->m_content = trim(substr($this->m_raw, strlen($matches[0])));
        }
    }
}

class Vector2d {
    public int $X;
    public int $Y;
    public function __construct(int|array $x, int $y = null) {
        if(is_array($x)) {
            $this->X = $x[0] ?? $x['x'] ?? 0;
            $this->Y = $x[1] ?? $x['y'] ?? 0;
        } else {
            $this->X = $x; 
            $this->Y = $y;
        }
    }
}

class Map {
    private string $m_planet;
    private float $m_scale;
    private Vector2d $m_size;
    private Vector2d $m_origin;
    public function __construct(WorldDocument $doc) {
        $this->parseHeader($doc->getHeader());
    }

    public static function Create(string $map_id): Map {
        $doc = WorldDocument::Load("map/$map_id");
        if(!$doc)
            throw new Exception("Unable to load document map/$map_id");

        return new Map($doc);
    }

    private function parseHeader(string $header_block): void {
        $data = (object)Yaml::parse($header_block);
        $this->m_planet = $data->planet;
        $this->m_origin= new Vector2d($data->origin);
        $this->m_size  = new vector2d($data->size);
        $this->m_scale = $data->scale;
    }
}



$map = Map::Create("teamanare");

var_dump($map);