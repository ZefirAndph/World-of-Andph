---
Class: Creature
Source: DnD 5E p159 - Wolf
Subclass: Medium beast
Align: unaligned
Stats:
  Str: 12
  Dex: 15
  Con: 12
  Int: 3
  Wis: 12
  Cha: 6
ArmorClass: 13
HitPoints: 2k8+2
Speed: 
  Walk: 8
Skills:
  Stealth: 4
  Perception: 3
Senses:
  Passive perception: 13
Traits: 
  - Name: Keen Hearing and Smel
    WisCheck: +Adv if UsesSense(Hearing|Smell)
  - Name: Pack Tactics
    AttackRoll: +Adv if AllyInRange(1)
Challenge: 1/4
Experience: 50
Actions:
  - Name: Bite
    Type: Attack
    Modifier: 4
    Distance: 1 Melee
    Range: 1 target
    OnHit: 
      Pierce: 2k4+2
    Traps: 
      - OnAttack: Str - 11 - /Prone
---
# Vlk

Bystrý sluch a čich. Vlk má výhodu k ověřením Moudrosti (Vnímání), která se opírají o sluch nebo čich.

Taktika smečky. Vlk má výhodu k hodům na útok proti tvorovi, je-li do 1 sáhu od tvora aspoň jeden vlkův spojenec, jenž není neschopný.

Akce
Kousnutí. Útok na blízko zbraní: +4 k zásahu, dosah 1 sáh, jeden cíl. Zásah: Bodné zranění 7 (2k4 + 2). 
Je-li cílem tvor, musí uspět v záchranném hodu na Sílu se SO 11, jinak je sražen k zemi.

