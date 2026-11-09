<?php
require __DIR__ . '/BulkSmsIndia.php';

$sms = new BulkSmsIndia(getenv('BSI_USERNAME'), getenv('BSI_API_KEY'));

// The message must match a DLT template approved for your sender ID.
echo $sms->send('9876543210', 'Your order #1001 is confirmed. - ShopIn', 'BSMSIN'), PHP_EOL;
echo $sms->balance(), PHP_EOL;
