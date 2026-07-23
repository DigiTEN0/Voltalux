#!/usr/bin/env bash
#
# Build an uploadable WordPress theme zip.
# Result: dist/voltalux.zip  (top-level folder "voltalux/" — ready for
# Weergave → Thema's → Thema uploaden)
#
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
THEME="voltalux"
OUT="$ROOT/dist"

cd "$ROOT"

if [ ! -f "$THEME/style.css" ]; then
  echo "ERROR: $THEME/style.css not found. Run from the repo root." >&2
  exit 1
fi

mkdir -p "$OUT"
rm -f "$OUT/$THEME.zip"

# Exclude junk; include everything the theme needs.
zip -r -q "$OUT/$THEME.zip" "$THEME" \
  -x '*.DS_Store' \
  -x '*/.git/*' \
  -x '*__MACOSX*' \
  -x '*.map'

echo "Built: $OUT/$THEME.zip"
unzip -l "$OUT/$THEME.zip" | tail -n 1
