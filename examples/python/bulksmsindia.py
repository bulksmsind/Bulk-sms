"""Minimal client for the Bulk SMS India HTTP SMS API.

Docs: https://bulksmsind.in/sms-api.html
"""
import requests

BASE = "http://sms.bulksmsind.in"


class BulkSmsIndia:
    def __init__(self, username: str, api_key: str, timeout: int = 15):
        self.auth = {"username": username, "apikey": api_key}
        self.timeout = timeout

    def _call(self, path: str, **params) -> str:
        r = requests.get(BASE + path, params={**self.auth, **params}, timeout=self.timeout)
        r.raise_for_status()
        return r.text

    def send(self, numbers: str, message: str, sender: str, smstype: str = "TRANS", scheduled: str | None = None) -> str:
        """numbers: one number or a comma-separated list. scheduled: yyyymmddhhmm (IST), optional."""
        extra = {"scheduled": scheduled} if scheduled else {}
        return self._call("/sendSMS", sendername=sender, smstype=smstype, numbers=numbers, message=message, **extra)

    def send_to_group(self, group: str, message: str, sender: str, smstype: str = "TRANS") -> str:
        return self._call("/sendSMSByGroupname", sendername=sender, smstype=smstype, gname=group, message=message)

    def balance(self) -> str:
        return self._call("/getSMSCredit")

    def delivery_status(self, msgid: str) -> str:
        return self._call("/getDLR", msgid=msgid)

    def delivery_report(self, date_from: str, date_to: str, sender: str) -> str:
        """Dates as yyyy-mm-dd."""
        return self._call("/getDLRReport", **{"from": date_from, "to": date_to, "sendername": sender})
