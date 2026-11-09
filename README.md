# Bulk SMS India – SMS API examples (PHP, Node.js, Python, cURL)

Code samples for the **[Bulk SMS India](https://bulksmsind.in/) HTTP SMS API**: send bulk, transactional and OTP SMS to Indian mobile numbers, schedule messages, check your balance and fetch delivery reports.

Bulk SMS India is a CPaaS provider and SMS aggregator in India, working since 2016 and connected directly to Airtel, Vi, BSNL and Jio. Besides SMS it offers the WhatsApp Business API, RCS, voice (OBD, IVR, missed call) and email.

- API documentation: https://bulksmsind.in/sms-api.html
- OpenAPI description: [`openapi.json`](openapi.json) (also at https://bulksmsind.in/openapi.json)
- Create an account: https://sms.bulksmsind.in/registernew

## Quick start

1. [Sign up](https://sms.bulksmsind.in/registernew) and get your **username** and **API key** from the panel (API section).
2. Register your entity, sender ID (header) and message templates on the TRAI **DLT** portal. Our team helps with this: [DLT registration guide](https://bulksmsind.in/dlt-registration-bulk-sms/).
3. Send your first SMS:

```bash
curl -G "http://sms.bulksmsind.in/sendSMS" \
  --data-urlencode "username=YOUR_USERNAME" \
  --data-urlencode "apikey=YOUR_API_KEY" \
  --data-urlencode "sendername=BSMSIN" \
  --data-urlencode "smstype=TRANS" \
  --data-urlencode "numbers=9876543210" \
  --data-urlencode "message=Your order #1001 is confirmed. - ShopIn"
```

The response contains the message ID. Use it with `getDLR` to check delivery.

## Examples in this repo

| Language | Client | Example |
|---|---|---|
| PHP 8 | [`examples/php/BulkSmsIndia.php`](examples/php/BulkSmsIndia.php) | [`send_sms.php`](examples/php/send_sms.php) |
| Node.js 18+ | [`examples/node/bulksmsindia.js`](examples/node/bulksmsindia.js) | [`send-sms.mjs`](examples/node/send-sms.mjs) |
| Python 3.10+ | [`examples/python/bulksmsindia.py`](examples/python/bulksmsindia.py) | [`send_sms.py`](examples/python/send_sms.py) |
| cURL / Bash | – | [`send-sms.sh`](examples/curl/send-sms.sh), [`check-balance.sh`](examples/curl/check-balance.sh) |

Each example reads credentials from the `BSI_USERNAME` and `BSI_API_KEY` environment variables.

## Endpoints

Base URL: `http://sms.bulksmsind.in`. All endpoints use HTTP GET with URL-encoded query parameters.

| Action | Endpoint | Parameters |
|---|---|---|
| Send SMS (one or many numbers) | `/sendSMS` | `username`, `apikey`, `sendername`, `smstype`, `numbers`, `message` |
| Schedule SMS | `/sendSMS` | as above + `scheduled` (`yyyymmddhhmm`, IST) |
| Send to a contact group | `/sendSMSByGroupname` | `username`, `apikey`, `sendername`, `smstype`, `gname`, `message` |
| Check balance | `/getSMSCredit` | `username`, `apikey` |
| Delivery status of one message | `/getDLR` | `username`, `apikey`, `msgid` |
| Date-wise delivery report | `/getDLRReport` | `username`, `apikey`, `from`, `to`, `sendername` |

## Best practices

- Call the API from your server and keep the API key in an environment variable. Never put it in a browser or mobile app.
- URL-encode the message and keep it exactly as your approved DLT template.
- Use `TRANS` for OTPs and alerts. Send promotional SMS only between 10 AM and 9 PM IST.
- Store the message ID and check delivery with `getDLR`.
- Rate-limit OTP requests per number to stop abuse.

## No-code integrations

- [WooCommerce / WordPress SMS plugin](https://bulksmsind.in/woocommerce-sms-plugin.html)
- [Zapier](https://bulksmsind.in/zapier-sms-integration.html), Pabbly Connect, Make and n8n
- [All integrations](https://bulksmsind.in/integrations.html)

## More from Bulk SMS India

- [Bulk SMS service](https://bulksmsind.in/sms-messaging.html)
- [Bulk SMS gateway and SMPP](https://bulksmsind.in/bulk-sms-gateway.html)
- [OTP SMS service](https://bulksmsind.in/otp-sms-service-india/)
- [WhatsApp Business API](https://bulksmsind.in/whatsapp-api.html)
- [RCS messaging](https://bulksmsind.in/rcs-messaging.html)

## Support

- Email: support@bulksmsind.in
- Phone: +91 90345 41288 (Mon–Sat, 10 AM–7 PM IST)
- WhatsApp: +91 73573 33334
- Website: https://bulksmsind.in/

## License

The example code in this repository is released under the [MIT License](LICENSE).
