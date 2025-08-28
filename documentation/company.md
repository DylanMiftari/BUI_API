## Documentation for company route (/api/company)

### Get companies of user
This route return all companies of user  
**Method :** GET  
**Route :** /my  
**Return :**
```json
[
    {
        "id": "id of the company",
        "name": "name of the company",
        "type": "type of the company",
        "activated": "boolean indicates if the company is activated",
        "level": "level of the company",
        "moneyInSafe": "money in the safe of the company"
    },
]
```
---

### Create a company
This route create a company for the connected user. It also create sub-company (bank, casino, mafia...)  
**Method :** POST  
**Route :** /  
**Payload :**
```json
{
    "name": "required | not empty | max length : 100",
    "type": "required | in : bank, casino, mafia, estate, factory, security"
}
```
**Return :**  
The created company
```json
{
    "id": "id of the company",
    "name": "name of the company",
    "type": "type of the company",
}
```
---
