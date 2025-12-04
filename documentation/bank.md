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

---
### Create loan request
Create a loan request
**Method :** POST  
**Route :** /account/loan 
**Payload :**
```json
{
    "money": 45000,
    "weeklyPayment": 2500,
    "description": "To buy a mine",
    "rate": 2 <Optional>
}
```
**Return :**
```json
{
    "id": 2,
    "status": "wait on bank",
    "money": 45000,
    "weeklypayment": 2500,
    "alreadyPayed": null,
    "rate": 2,
    "description": "To buy a mine"
}
```
---

### Get loan request
Get loan requests of the user for a specific bank
**Method :** GET  
**Route :** /account/loan
**Return :**
```json
[
    {
        "id": 2,
        "status": "wait on bank",
        "money": 45000,
        "weeklypayment": 2500,
        "alreadyPayed": null,
        "rate": 2,
        "description": "To buy a mine"
    },
    ...
]
```
