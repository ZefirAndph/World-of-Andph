# lib/repository.py
import subprocess
from pathlib import Path


class Repository:
    def __init__(self, root: Path | None = None):
        self.root = root or self._find_root()

    def _find_root(self) -> Path:
        result = subprocess.run(
            ["git", "rev-parse", "--show-toplevel"],
            capture_output=True, text=True, check=True,
        )
        return Path(result.stdout.strip())

    @property
    def cache_dir(self) -> Path:
        return self.root / ".cache"