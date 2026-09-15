from dataclasses import dataclass, field
from pathlib import Path
from typing import Any
@dataclass
class CharacterSheet:
    id: str = ""
    name: str = ""
    race_id: str = ""
    race: str = ""
    subrace_id: str = ""
    subrace: str = ""
    classes_id: dict[str, int] = field(default_factory=dict)
    classes: str = ""

@dataclass
class DataFile:
    path: Path = None
    meta: dict[str, Any] = field(default_factory=dict)
    cont: str = ""
    @property
    def id(self) -> str:
        return self.path.stem
