## Documentation for company route (/api/company)


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
    "data": {
        "id": "id of the company",
        "name": "name of the company",
        "type": "type of the company",
    }
}
```
---