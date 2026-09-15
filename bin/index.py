#!/usr/bin/env python3
import json
from pathlib import Path
import frontmatter
import yaml
from lib.find_root import find_repo_root

root = find_repo_root()

index = []
for md_path in Path(root).rglob("*.md"):
  file = Path(str(md_path))
  try:
        post = frontmatter.load(md_path)
  except yaml.YAMLError as e:
        print(f"⚠ Chyba YAML v souboru: {file}")
        print(f"  {e}")
        continue

  post = frontmatter.load(md_path)
  if(post.metadata.get("class") is not None):
    index.append({
      "id": file.stem,
      "class": post.metadata.get("class"),
      "parent": file.parent.parts,
      "path": str(file)
    })

#print(index)
#index_opt = json.dumps(index, ensure_ascii=False, indent=2)
#print(index_opt)
# (Path("runtime_data/index.json").write_text(index_opt))