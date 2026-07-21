---
class: disease
id: vampirism
name: Vampirismus
vector: blood
is_magic: false
survived_silence: true
mutations:
  - id: cyntaf
    name: Mutace cyntaf
    status: draft
tags:
  - nemoc
  - upír
  - krev
---

# Vampirismus

## Co to je

Krví přenosná nákaza, která nezabíjí, nýbrž **mění**. Nakažený neumírá a nevstává z mrtvých; zůstává tím, kým byl, jen s jinými potřebami a jiným tělem.

## Původ

Vampirismus **nevznikl sám od sebe**. Byl vyvinut — záměrně, prací a úmyslem — v [Lidském císařství](human.md).

To je na celé věci to podstatné a mění to povahu všeho ostatního. Nejde o mor, který přišel odněkud zvenčí a jehož původ se ztrácí. Jde o **dílo**. Někdo je zadal, někdo na něm pracoval, někomu k něčemu mělo sloužit — a to, co dnes koluje světem v několika rozbíhajících se liniích, je jeho následek, nikoliv jeho záměr.

> Císařství zatím nemá vlastní zápis. Vše níže je s ním třeba sladit, až vznikne.

## Není to kletba

Toto je nejdůležitější tvrzení celého spisu a zároveň jediné, které lze doložit.

Na konci prvního věku [selhala veškerá magie](../world/history/eras/age_of_gods.md). Byly zlomeny **všechny kletby i požehnání** a všechny magické konstrukty se rozpadly.

Vampirismus to přežil.

Z toho plyne jediný možný závěr: **není to kletba, ani prokletí, ani dílo bohů.** Je to nemoc. Chová se jako nemoc, přenáší se jako nemoc a — což je na tom nejnepříjemnější — jako nemoc **mutuje**.

Ti, kdo tvrdí opak, musí vysvětlit, proč jediné prokletí na světě přečkalo noc, kdy praskla všechna ostatní. Zatím to nedokázal nikdo.

> [!warning] Závislost — nutno rozhodnout
> **Tento důkaz platí pouze tehdy, je-li vampirismus starší než konec prvního věku.**
>
> Byl-li vyvinut až ve věku třetím, Ticho nikdy nepřečkal, žádnou zkouškou neprošel a celá úvaha padá — pak zůstává otevřené, zda magický není. Datace císařství tedy rozhoduje o povaze nákazy, ne naopak.

## Mutace

Vampirismus není jedna věc. Je to **rod nákaz** se společným původem a rozbíhajícími se projevy; jednotlivé linie se od sebe liší tak výrazně, že je laik nepovažuje za příbuzné.

Mutace se značí řadovými jmény ve staré řeči: **cyntaf**, ail, trydydd, pedwerydd…

Společné všem známým liniím:

| | |
|---|---|
| `vector` | krev do krve; nikoliv dech, dotek ani pohled |
| `retains_self` | nakažený si podrží paměť, rozum i povahu |
| `no_undeath` | nejde o nemrtvost — nakažený nikdy nezemřel |
| `sunlight` | přímé sluneční světlo poškozuje, míra se liší dle linie |
| `heritable` | nepřenáší se plozením |

---

# Mutace cyntaf

> Linie první popsaná a dosud nejlépe zdokumentovaná. Nákaza městská, tichá a společenská — právě proto nejnebezpečnější.

## Průběh nákazy

Nákaza proběhne krví do krve, nejčastěji při krmení, které oběť přežije. Nemoc se projeví během několika dní: horečka, žízeň, kterou nelze uhasit vodou, a pak už jen ono.

Nakažený **si podrží všechno**: paměť, rozum, řemeslo, přátele, dluhy, city. Tohle je jádro celé linie. Nevzniká netvor, kterého lze zabít bez rozpaků. Vzniká **týž člověk s novou potřebou** — a se všemi vazbami, které měl včera.

## Krev

Nakažený se udrží naživu i na zvířecí krvi. Nezesílí z ní.

Sílu dává pouze krev **myslící bytosti**, a to tím větší, čím je ta bytost pro upíra hodnotnější — v obou významech toho slova.

### Jakost krve — `blood_quality`

| Stupeň | Stav oběti |
|---|---|
| `spoiled` | nemocná, hladová, umírající |
| `poor` | vyčerpaná, zanedbaná |
| `sound` | zdravá, najedená, odpočatá |
| `excellent` | zdravá, v duševní pohodě, bez bolesti |

Z toho plyne první z obou zvrhlostí této linie: **upír má zájem na tom, aby lidé kolem něj byli zdraví.** Léčit, sytit, konejšit a hojit se vyplácí. Kdo ošetřuje raněné, pečuje o nemocné a zná byliny, je zároveň nejlépe vybaven k tomu, aby si vypěstoval lepší kořist.

Hranice mezi lékařem a chovatelem tu neexistuje. Je to tatáž práce.

### Známost — `intimacy`

Druhá zvrhlost, a horší.

Krev cizince vydá málo. Krev někoho, koho upír **zná** — jehož jméno, dětství, tajemství, strach a naději si vyslechl — vydá násobně víc.

| Stupeň | Co o oběti upír ví |
|---|---|
| `stranger` | jméno, tvář |
| `acquaintance` | řemeslo, rodina, denní běh |
| `confidant` | starosti, dluhy, hanba |
| `intimate` | to, co oběť neřekla nikomu |

Naslouchat je tedy prospěšné. Ptát se je prospěšné. Být tím, komu se lidé svěří, je nejprospěšnější ze všeho.

Upír linie cyntaf se nevkrádá do domů. **Je zván.** A každý večer strávený u cizího stolu, každá vyslechnutá starost a každá upřímně míněná útěcha zvyšuje cenu toho člověka — i tehdy, kdy to upír tak nemyslí. Zvlášť tehdy.

## Vůle a okouzlení — `mesmer`

Upír dokáže omámit toho, jehož **Vůle (VUL)** nepřevyšuje jeho vlastní míru okouzlení. Omámený jde, kam je veden, nebrání se a nazítří si nevzpomene.

Koho okouzlit nelze, toho lze pouze přemoci — a to je hlučné, viditelné a zanechává stopy.

`mesmer` roste s postupem. Kdo je slabý, nemá na vybranou a bere, koho unese. Kdo je silný, může si vybírat — a právě tehdy začínají volby, které stojí za hru.

## Hlad — `hunger`

Hlad stoupá časem. Zvířecí krev jej srazí, nikoliv však na dno.

| `hunger` | Stav |
|---|---|
| 0–1 | klid |
| 2–3 | neodbytnost, podrážděnost, špatný spánek |
| 4–5 | postihy na jednání a soustředění; pach krve ruší |
| 6 | **žízeň** — nakažený už nerozhoduje sám |

Zdrženlivost je možná. Je ale trvale nevýhodná: kdo nepije z myslících, **nepostupuje**. Zůstane tím, čím byl v den nákazy, zatímco svět kolem sílí.

To je nabídka, kterou tahle linie dělá každému nakaženému, znovu a znovu: *zůstaň slabý a čistý, nebo posilni a plať.*

## Obec — `community`

Každé úmrtí se počítá. Ne mravně — **prakticky**.

Lidé mizí, sousedé si všímají, hlídky houstnou, dveře se zavírají dřív. Obec (čtvrť, vesnice, cech, posádka) má stav:

| Stav | Projev |
|---|---|
| `calm` | běžný život, dveře otevřené, upír vítán |
| `uneasy` | šeptá se, po setmění se chodí ve dvou |
| `hostile` | hlídky, podezření, zavřené krámy, jmenovaní podezřelí |
| `broken` | obec se rozpadá — kdo může, odchází; zbytek loví |

Stav se **nevrací sám od sebe** rychle. A `broken` obec je pro upíra zkázou dvojí: nemá z čeho brát a je vidět.

Tady leží skutečná hra. Ne v tom, zda zabít, ale v tom, **koho si můžeš dovolit ztratit** — a jak dlouho vydržíš na místě, kde znáš každého jménem.

## Meze

- **Slunce** — přímé světlo pálí a rychle vysiluje. Zataženo a stín jsou snesitelné.
- **Pozvání** — do obydleného domu vejde upír linie cyntaf jen tehdy, je-li vpuštěn. Právě proto je pro něj společenský styk existenční nutností, nikoliv rozmarem.
- **Stárnutí** — nakažený nestárne. Ve městě, kde ho znají, jsou to hodiny tikající proti němu.
- **Odraz, tekoucí voda, česnek** — pověry. Žádná z nich neplatí, ale všechny jsou rozšířené, což upírovi hraje do karet.

## Postup — `progression`

Síla se získává **výhradně** krví myslících bytostí. Výnos jednoho krmení:

```txt
yield = blood_quality × intimacy
```

Nejvýnosnější obětí je tedy vždy **zdravý člověk, kterého máš rád a který ti věří**.

Systém není určen k tomu, aby se dal vyřešit. Je určen k tomu, aby se každé jeho vyřešení dalo někomu vyčítat.

> [!danger]- Pravda (GM)
> Vzorec je záměrně krutý a hráč by ho měl znát **předem**. Hrůza nespočívá v odhalení; spočívá v tom, že hráč celou dobu ví, koho by se vyplatilo sníst, a musí se rozhodovat znovu a znovu.
>
> Cesta úplné zdrženlivosti musí zůstat průchodná — a musí být poctivě těžká. Nesmí být odměněna. Pokud se abstinujícímu upírovi nakonec všechno vyrovná, celá linie ztrácí smysl.

## Otevřené otázky

- **Kdy a proč ji [císařství](human.md) vyvinulo?** K čemu měla sloužit a dostala se z rukou, nebo dělá přesně to, co měla?
- **Souvisí s Nesmrtelným císařem?** Císařští jako jediná lidská kultura neuctívají Pantheon Středu, nýbrž **člověka, který neumírá**. Vznik nákazy prodlužující život v témže státě je shoda, kterou lze těžko přejít.
- **Jak se dostala na Terth?** Ať vznikla kdekoliv, na ostrov vede jediná cesta — [Raabul](../world/characters/npc/Alethis.md). Původ a cesta nákazy jsou dvě různé otázky a Raabul odpovídá na tu druhou.
- **Jak se chová v [elfovi](../world/cultures/races/elf.md)?** Elfové jsou protkáni magií a citliví na její tkanivo; nemoc, která magická není, se v nich může chovat úplně jinak. Elf navíc nestárne tak jako tak — co pak nákaza vlastně přidá?
- **Jsou [Krvaví elfové](../world/cultures/nations/elf.md) jednou z mutací?** V kánonu už existují jako následek toho, že elfové byli příliš dlouho namačkáni k sobě v úzkosti. To je epidemiologicky velmi příhodné prostředí.
- Existovala linie cyntaf už v prvním věku, nebo je mladší než Ticho?
- Co na to bůh **Smrti** z prvního sedmera? Nákaza, která nikoho nezabíjí a nikoho nepouští dál, mu bere, co je jeho.
- Vědí o vampirismu [bohové](../world/entities/deities/creator.md), a je to něco, co stvořili — nebo něco, co vzniklo samo, bez nich?
