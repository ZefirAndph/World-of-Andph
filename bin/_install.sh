#!/usr/bin/env bash
set -euo pipefail

REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
VENV_DIR="$REPO_ROOT/.venv"

echo "==> Kontrola Pythonu"
if ! command -v python3 >/dev/null 2>&1; then
    echo "python3 nenalezen. Nainstaluj: sudo apt install python3"
    exit 1
fi

echo "==> Vytvářím virtuální prostředí v $VENV_DIR"
if [ ! -d "$VENV_DIR" ]; then
    python3 -m venv "$VENV_DIR"
fi

if [ ! -f "$VENV_DIR/bin/activate" ]; then
    echo ""
    echo "Venv se nevytvořil správně (chybí bin/activate)."
    echo "Zkus: sudo apt install python3-venv"
    exit 1
fi

echo "==> Instaluji závislosti"
"$VENV_DIR/bin/pip" install --upgrade pip
"$VENV_DIR/bin/pip" install -r "$REPO_ROOT/requirements.txt"

echo ""
echo "Ještě aktivuji prostředí."

source .venv/bin/activate

echo "Hotovo! vypneš to s 'deactivate'"