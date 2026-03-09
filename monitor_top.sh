#!/bin/bash

URL="luxeglow.jp.testrs.jp/dev_fds90sdyvcs2/"
LOGDIR="$HOME/monitor_top"
mkdir -p "$LOGDIR"

ts=$(date +"%Y%m%d-%H%M%S")

code=$(curl -L -s \
  --connect-timeout 10 \
  --max-time 20 \
  -o "$LOGDIR/body-$ts.html" \
  -D "$LOGDIR/head-$ts.txt" \
  -w "%{http_code}" \
  "$URL")

if [ "$code" != "200" ]; then

  {
    echo "===== ERROR DETECTED ====="
    echo "Time: $(date)"
    echo "HTTP Status: $code"
    echo ""
    echo "--- Disk usage (home) ---"
    du -sh ~
    echo ""
    echo "--- public_html usage ---"
    du -sh ~/public_html
    echo ""
    echo "--- wp-content usage ---"
    du -sh ~/public_html/luxeglow.jp.testrs.jp/dev_fds90sdyvcs2/wp-content 2>/dev/null
  } > "$LOGDIR/system-$ts.txt"

else
  rm -f "$LOGDIR/body-$ts.html" "$LOGDIR/head-$ts.txt"
fi