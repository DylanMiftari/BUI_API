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
---
### Debit account
Remove money from bank account and place 
money on the player  
**Method :** PATCH  
**Route :** /account/debit  
**Payload :**
```json
{
    "amount": 1000
}
```
**Return :** 204 No Content
---
### Credit account
Add money on bank account from player's money 
**Method :** PATCH  
**Route :** /account/credit  
**Payload :**
```json
{
    "amount": 1000
}
```
**Return :** 204 No Content
---
### Transfer money between two accounts
Transfer money between two accounts 
**Method :** PATCH  
**Route :** /account/transfer  
**Payload :**
```json
{
    "amount": 1000,
    "destinationAccount": 1
}
```
**Return :** 204 No Content
