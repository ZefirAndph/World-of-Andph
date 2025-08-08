Objevujme strukturu repozitáře... 
### Base formát
```md
---
yaml: metadata
  klidně: zanořená

---
# Základní formát
```
### Tabulky
```md
---
columns:
  - name: name
    type: string
  - name: class
    type: enum
    enum: [Warrior, Sorcerer, Thief]
  - name: level
    type: integer
    min: 1
    max: 20

rows:
  - name: Elric
    class: Sorcerer
    level: 5
  - name: Thorin
    class: Warrior
    level: 8
---

# Tabulka něčeho...
Co i nějaký další content si nese.. 
```

### Chunks
```md
---
chunks:
  - type: ChunkHeader
    data:
      id: blemca
      version: 1

  - type: ChunkStrings
    data:
      - Ahojka bababi
      - Tadyktok

  - type: ChunkData
    data:
      encoding: base64
      raw: !!binary |
        f0VMRgIBAQAAAAAAAAAAAAI...

---

# Nějaký chunkový struktur
```