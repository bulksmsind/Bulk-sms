#!/usr/bin/env bash
# Send an SMS with the Bulk SMS India HTTP API.
# Usage: BSI_USERNAME=... BSI_API_KEY=... ./send-sms.sh 9876543210 "Your order #1001 is confirmed. - ShopIn"
set -euo pipefail
curl -sG "http://sms.bulksmsind.in/sendSMS" \
  --data-urlencode "username=${BSI_USERNAME}" \
  --data-urlencode "apikey=${BSI_API_KEY}" \
  --data-urlencode "sendername=${BSI_SENDER:-BSMSIN}" \
  --data-urlencode "smstype=${BSI_SMSTYPE:-TRANS}" \
  --data-urlencode "numbers=$1" \
  --data-urlencode "message=$2"
echo
