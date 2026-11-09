import os

from bulksmsindia import BulkSmsIndia

sms = BulkSmsIndia(os.environ["BSI_USERNAME"], os.environ["BSI_API_KEY"])

# The message must match a DLT template approved for your sender ID.
print(sms.send("9876543210", "Your order #1001 is confirmed. - ShopIn", sender="BSMSIN"))
print(sms.balance())
