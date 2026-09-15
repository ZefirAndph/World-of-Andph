---
doctype: creature
type: [beast, tiny, unaligned]
speeds: 
  ground: 10
  fly: 50
armor_class: 12
hitpoints: 1 (1d4-1)
abilities:
  str: 2
  dex: 14
  con: 8
  int: 2
  wis: 12
  cha: 6
skills:
  perception: 3
senses:
  passive-perception: 13
challenge: 0
traits:
  - name: Mimicry
    desc: 
      The raven can mimic simple sounds it has heard, such as a person 
      whispering, a baby crying, or an animal chittering. A creature that 
      hears the sounds can tell they are imitations with a successful 
      DC 10 Wisdom (Insight) check.
actions:
  - name: Beak
    type: melee_weapon_attack
    add_hit: 4
    reach: 5
    targets: 1
    damage:
      piercing: 1 
    desc: "Melee Weapon Attack: +4 to hit, reach 5 ft., one target."
---