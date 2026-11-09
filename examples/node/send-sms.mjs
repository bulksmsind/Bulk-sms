import { createClient } from './bulksmsindia.js';

const sms = createClient({ username: process.env.BSI_USERNAME, apiKey: process.env.BSI_API_KEY });

// The message must match a DLT template approved for your sender ID.
console.log(await sms.send({ numbers: '9876543210', message: 'Your order #1001 is confirmed. - ShopIn', sender: 'BSMSIN' }));
console.log(await sms.balance());
