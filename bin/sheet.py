#!/usr/bin/env python3
import argparse
from pathlib import Path
from lib.indexer import Indexer
from lib.character import CharacterMgr


def main():
    # Get arguments
    parser = argparse.ArgumentParser(description="Calculate character sheet.")
    parser.add_argument("character", help="Character name")
    parser.add_argument("--no-cache", action="store_true", 
        help="Force reload index, invalidate cache")
    args = parser.parse_args()

    # reload cache if forced
    if args.no_cache:
        indexer = Indexer()
        indexer.reload(force=True)

    # get charactersheet
    charMgr = CharacterMgr()
    p = charMgr.get(args.character)

    print(vars(p))

if __name__ == "__main__":
    main()