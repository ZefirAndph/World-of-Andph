# World-of-Andph
Po všech pokusech a ztrátách nakonec volím pro uložení informací o světě Andph Github a doufám, že o data už znova nepřijdu.

#### Čtení dat
1. Raw format from public GitHub
1. GithubApi
1. Pandoc conversions
1. Graphviz (dot) conversions

## Dokumentace struktur
### Entity
<!-- 
| Id | Česky | Význam / Popis |
|:----------:|:-------:| --------------------------------------------------------- |
| kingdom    | říše    | Nejvyšší úroveň – např. živočichové, rostliny             |
| phylum     | kmen	   | Např. strunatci, členovci, houby                          |
| class	     | třída   | Např. savci, ptáci, plazi                                 |
| order	     | řád     | Např. šelmy, hlodavci, jehličnany                         |
| family     | čeleď   | Např. kočkovití, růžovité, borovicovité                   |
| genus      | rod     | Např. kočka (Felis), růže (Rosa), borovice (Pinus)        |
| species    | druh    | Např. kočka domácí (Felis catus), růže šípková            |
| subspecies | poddruh | Např. kočka divoká evropská (Felis silvestris silvestris) |

## Zpracovávání dat
Všechny soubory podporují hlavičkový zápis (meta data) s obsahem. 
Název souboru představuje jeho **ID** a rozlišujeme taky **DOC_ID** které představuje ID spolu s hiearchickou strukturou z rootu (např.: DOC_ID **event/grunmul** má vlastní ID **grunmul**). -->
```md
---
class: Drak
names:
    base: Balthazar
    alt: Baltík
---

# Drak Balthazar
Drak narozený v pohoří Tararingapatám, v odlehlé zemi Tarangapatáliónu.
```
### Struktury (hlavičky)
```cpp
struct sEntityType {
    std::unodered_map<std::string /*lang*/, std::string> names;
    struct sTaxonomy {
        std::string Kingdom;    // Říše
        std::string Phylum;     // Kmen
        std::string Class;      // Třída
        std::string Order;      // Řád
        std::string Family;     // Čeleď
        std::string Genus;      // Rod
        std::string Species;    // Druh
        std::string SubSpecie;  // Poddruh
    } Taxonomy;
    
    struct sStatsRanges {
        IntVector2d Str;
        IntVector2d Dex;
        IntVector2d Sta;
        IntVector2d Int;
        IntVector2d Chr;
    } StatRanges;

    std::vector<std::string> Tags;
    std::vector<std::string> Properties;
};

struct sEntity {
    std::string name;
    sEntityType base;
    struct sStats {
        int Str;
        int Dex;
        int Sta;
        int Int;
        int Chr;
    } Stats;
};
```