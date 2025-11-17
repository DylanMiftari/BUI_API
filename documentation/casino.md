## Documentation for casino route (/api/casino)

### Get all casino tickets of the user
This route return all (non expired) casino tickets of the user 
**Method :** GET  
**Route :** /tickets  
**Return :**
```json
[
    {
        "id": "ticket id",
        "isVIP": "boolean to indicate if the ticket is a vip ticket",
        "createdAt": "The buy date of the ticket",
        "casino": {
            "id": "id of the casino",
            "company": {
                "id": "id of the company",
                "name": "name of the casino",
                "type": "casino",
                "activated": 1,
                "level": "level of the company"
            }
        }
    },
    ...
]
```
---

### Buy a ticket
This route buy a ticket for a user  
**Method :** POST  
**Route :** /{casino}/buy  
**Payload :**
```json
{
    "isVIP": "boolean indicate if the bought ticket is VIP"
}
```
**Return :**
```json
{
    "id": "ticket id",
    "isVIP": "boolean to indicate if the ticket is a vip ticket",
    "createdAt": "The buy date of the ticket",
    "casino": {
        "id": "id of the casino",
        "company": {
            "id": "id of the company",
            "name": "name of the casino",
            "type": "casino",
            "activated": 1,
            "level": "level of the company"
        }
    }
}
```
