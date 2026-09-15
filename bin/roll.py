#!/usr/bin/env python3
import random
import re
import argparse

def roll(sides: int, dices: int = 1, mod: int = 0) -> int:
    res = 0
    for _ in range(dices):
        res += random.randint(1, sides)
    res += mod
    return res

def main():
    parser = argparse.ArgumentParser(description="Calculate character sheet.")
    parser.add_argument("dicestr", help="Roll info (1d6 2k10, ...)")
    args = parser.parse_args()

    pattern = r"^(?P<dices>\d+)(?:d|k)(?P<sides>\d+)(?:(?P<sig>\+|-)(?P<mod>\d+))?$"

    match = re.search(pattern, args.dicestr)
    if match:
        data = match.groupdict()
        dices = int(data["dices"])
        sides = int(data["sides"])
        sig = data["sig"]
        mod = int(data["mod"]) if data["mod"] else 0

        mod = mod if sig == "+" else -mod
        
        res = roll(sides, dices, mod)

        print(f"You rolled {args.dicestr} for: {res}")
    else:
        print(f"Invalid input format: {args.dicestr}")

if __name__ == "__main__":
    main()