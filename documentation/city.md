## Documentation for city route (/api/city)

### Get city of the user
This route return all data about the city of the user  
**Method :** GET  
**Route :** /my  
**Return :**  
```json
{
    "id": "id of the city",
    "name": "name of the city",
    "country": "country of the city",
    "max_level_of_corp": "max level of companies in the city",
    "weekly_taxes": "weekly taxes in the city",
    "weekly_company_taxes": "weekly company taxes in the city",
    "rank": "rank of the city"
}
```
---