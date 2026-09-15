#!/usr/bin/env python3
import argparse
from pathlib import Path
from lib.indexer import Indexer


def main():
    parser = argparse.ArgumentParser(description="Calculate character sheet.")
    parser.add_argument("character", help="Character name")
    parser.add_argument("--no-cache", action="store_true", help="Force reload index, invalidate cache")
    args = parser.parse_args()


    indexer = Indexer()
    if args.no_cache:
        indexer.reload(force=True)
        
    path = indexer.get("character", args.character)

if __name__ == "__main__":
    main()