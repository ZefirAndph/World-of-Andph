import json
import time
from pathlib import Path
from .datatype import DataFile
import frontmatter
import yaml

from .repository import Repository

class Indexer:
    def __init__(self, repository: "Repository | None" = None, cache_path: Path | None = None):
        self.repository = repository or Repository()
        self.cache_path = cache_path or (self.repository.cache_dir / "index.json")
        self._index: dict[tuple[str, str], Path] = {}
        self._loaded = False
    
    def get(self, doctype: str, eid: str) -> DataFile | None:
        path = self.get_path(doctype, eid)
        if path is None:
            return None
        dfile = DataFile()
        dfile.path = path

        if path.suffix == ".md":
            fm = frontmatter.load(path)
            dfile.meta = fm.metadata
            dfile.cont = fm.content

        # ToDo: implement yaml + .loc.md
        
        return dfile


    def get_path(self, doctype: str, entity_id: str) -> Path | None:
        if not self._loaded:
            self.reload()
        return self._index.get((doctype, entity_id))

    def all(self, doctype: str | None = None) -> dict:
        if not self._loaded:
            self.reload()
        if doctype is None:
            return dict(self._index)
        return {k: v for k, v in self._index.items() if k[0] == doctype}

    def reload(self, force: bool = False):
        """Znovu postaví index — z cache, pokud je platná, jinak skenem repa."""
        if not force and self._try_load_cache():
            self._loaded = True
            return

        self._index = self._scan_repo()
        self._save_cache()
        self._loaded = True
    
    # --- interní metody ---

    def _scan_repo(self) -> dict:
        index = {}
        for path in list(self.repository.root.rglob("*.md")) + \
                    list(self.repository.root.rglob("*.yaml")) + \
                    list(self.repository.root.rglob("*.yml")):
            if any(part.startswith(".") for part in path.parts):
                continue

            metadata = self._load_metadata(path)
            doctype = metadata.get("doctype")
            if doctype is None:
                print(f"File '{path}' doestn have doctype ...ignored! ")
                continue

            key = (doctype, path.stem)
            if key in index:
                print(f"⚠ Duplicitní id '{path.stem}' v doctype '{doctype}': "
                      f"{index[key]} vs {path}")
                continue
            index[key] = path
        return index

    def _load_metadata(self, path: Path) -> dict:
        if path.suffix == ".md":
            return frontmatter.load(path).metadata
        elif path.suffix in (".yaml", ".yml"):
            with open(path, "r", encoding="utf-8") as f:
                return yaml.safe_load(f) or {}
        return {}

    def _try_load_cache(self) -> bool:
        if not self.cache_path.exists():
            return False

        with open(self.cache_path, "r", encoding="utf-8") as f:
            cache = json.load(f)

        self._index = {
            tuple(k.split("::", 1)): Path(v)
            for k, v in cache["entries"].items()
        }
        return True

    def _save_cache(self):
        self.cache_path.parent.mkdir(parents=True, exist_ok=True)
        data = {
            "built_at": time.time(),
            "entries": {
                f"{doctype}::{entity_id}": str(path)
                for (doctype, entity_id), path in self._index.items()
            },
        }
        with open(self.cache_path, "w", encoding="utf-8") as f:
            json.dump(data, f, indent=2, ensure_ascii=False)