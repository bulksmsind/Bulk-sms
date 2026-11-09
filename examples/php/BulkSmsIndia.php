<?php
/**
 * Minimal client for the Bulk SMS India HTTP SMS API.
 * Docs: https://bulksmsind.in/sms-api.html
 */
class BulkSmsIndia
{
    private const BASE = 'http://sms.bulksmsind.in';

    public function __construct(private string $username, private string $apiKey) {}

    private function call(string $path, array $params): string
    {
        $params = ['username' => $this->username, 'apikey' => $this->apiKey] + $params;
        $ctx = stream_context_create(['http' => ['timeout' => 15]]);
        $res = file_get_contents(self::BASE . $path . '?' . http_build_query($params), false, $ctx);
        if ($res === false) {
            throw new RuntimeException('Request to Bulk SMS India failed');
        }
        return $res;
    }

    /** Send to one number or a comma-separated list. $scheduled: yyyymmddhhmm (IST), optional. */
    public function send(string $numbers, string $message, string $sender, string $smstype = 'TRANS', ?string $scheduled = null): string
    {
        $p = ['sendername' => $sender, 'smstype' => $smstype, 'numbers' => $numbers, 'message' => $message];
        if ($scheduled) { $p['scheduled'] = $scheduled; }
        return $this->call('/sendSMS', $p); // response contains the message ID
    }

    public function sendToGroup(string $group, string $message, string $sender, string $smstype = 'TRANS'): string
    {
        return $this->call('/sendSMSByGroupname', ['sendername' => $sender, 'smstype' => $smstype, 'gname' => $group, 'message' => $message]);
    }

    public function balance(): string { return $this->call('/getSMSCredit', []); }

    public function deliveryStatus(string $msgId): string { return $this->call('/getDLR', ['msgid' => $msgId]); }

    /** $from, $to: yyyy-mm-dd */
    public function deliveryReport(string $from, string $to, string $sender): string
    {
        return $this->call('/getDLRReport', ['from' => $from, 'to' => $to, 'sendername' => $sender]);
    }
}
