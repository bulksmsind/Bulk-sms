// Minimal client for the Bulk SMS India HTTP SMS API (Node.js 18+, no dependencies).
// Docs: https://bulksmsind.in/sms-api.html
const BASE = 'http://sms.bulksmsind.in';

export function createClient({ username, apiKey }) {
  async function call(path, params) {
    const qs = new URLSearchParams({ username, apikey: apiKey, ...params });
    const res = await fetch(`${BASE}${path}?${qs}`, { signal: AbortSignal.timeout(15000) });
    if (!res.ok) throw new Error(`Bulk SMS India HTTP ${res.status}`);
    return res.text();
  }
  return {
    // numbers: one number or a comma-separated list; scheduled: yyyymmddhhmm (IST), optional
    send: ({ numbers, message, sender, smstype = 'TRANS', scheduled }) =>
      call('/sendSMS', { sendername: sender, smstype, numbers, message, ...(scheduled ? { scheduled } : {}) }),
    sendToGroup: ({ group, message, sender, smstype = 'TRANS' }) =>
      call('/sendSMSByGroupname', { sendername: sender, smstype, gname: group, message }),
    balance: () => call('/getSMSCredit', {}),
    deliveryStatus: (msgid) => call('/getDLR', { msgid }),
    deliveryReport: ({ from, to, sender }) => call('/getDLRReport', { from, to, sendername: sender }),
  };
}
