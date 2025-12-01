## Documentation for bank route (/api/bank)

### Create bank account
This route create a bank account, you can't create a bank account if you already have 
a bank account in the bank
**Method :** POST  
**Route :** /{bank}/create-account  
**Return :**
```json
{
    "id": 3,
    "accountMaintenanceCost": 1000,
    "transferCost": 0.02,
    "money": 0,
    "maxMoney": 50000,
    "isEnable": true
}
```
---
### Get all bank accounts of the user
This route return all bank accounts of the 
user
**Method :** GET  
**Route :** /bank-accounts 
**Return :**
```json
[
    {
        "id": 3,
        "accountMaintenanceCost": 1000,
        "transferCost": 0.02,
        "money": 0,
        "maxMoney": 50000,
        "isEnable": true
    },
    ...
]
```
