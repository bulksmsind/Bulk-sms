#!/usr/bin/env bash
# Check remaining SMS credits.
set -euo pipefail
curl -sG "http://sms.bulksmsind.in/getSMSCredit" \
  --data-urlencode "username=${BSI_USERNAME}" \
  --data-urlencode "apikey=${BSI_API_KEY}"
echo
