import frontmatter
import re
from .datatype import CharacterSheet, DataFile
from .indexer import Indexer

class CharacterMgr:
    def __init__(self):
        self.index = Indexer()

    def get(self, id: str) -> CharacterSheet | None:
        ch = self.index.get("character-sheet", id)
        if ch is None: 
            print(f"Character '{id}' does not exists.")
            return None
        
        sheet = CharacterSheet()
        sheet.id = ch.path.stem
        sheet.name = self._get_name(ch)
        # sheet.race = self._get_race(ch)
        # sheet.subrace = self._get_subrace(ch)
        # sheet.classes = self._get_classes(ch)
        return sheet
    
    def _get_name(self, raw: DataFile)-> str:
        return self._title(raw)
    
    # def _get_race(self, fm: frontmatter) -> str | None:
    #     race_id = fm.metadata.get("race")
    #     path = self.index.get_path("race", race_id)
    #     rfm = frontmatter.load(path)

    #     return self._title(rfm.content) or rfm.metadata.get("name") or race_id

    # def _get_subrace(self, fm: frontmatter) -> str | None:
    #     subrace_id = fm.metadata.get("subrace")
    #     if subrace_id is None:
    #         return None
    #     path = self.index.get_path("race", subrace_id)
    #     if path is None:
    #         return f"Nemáme subrasu! {subrace_id}"
    #     srfm = frontmatter.load(path)
    #     return self._title(srfm.content) or srfm.metadata.get("name") or subrace_id

    # def _get_classes(self, fm: frontmatter) -> dict[str, int]:
    #     result = {}
    #     for pclass, plevel in fm.metadata.get("class").items():
    #         result[pclass] = plevel
    #     return result

    def _title(self, raw: DataFile) -> str | None:
        match = re.search(r"^#\s+(.*)$", raw.cont, re.MULTILINE)
        return match.group(1).strip() or DataFile.meta.get("name") or DataFile.id