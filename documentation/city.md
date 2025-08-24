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

### Get all companies of the user's city
This route return all companies in the user's city. The result is paginated  
**Method :** GET  
**Route :** /my/company  
**Query params :**
- page: the current page
- per_page: number of companies in each pages
- name: search companies by its name
- type: filter companies by type
- level: filter companies by level  

**Return :**  
```json
{
    "data": [ // all companies
        {
            "id": "id of the company",
            "name": "name of the company",
            "type": "type of the company",
            "activated": "boolean indicates if the company is activated",
            "level": "level of the company",
            "owner_name": "name of the owner of the company"
        }
        ...
    ],
    "links": { // all links
        "first": "link of the first page",
        "last": "link of the last page",
        "prev": "link of the previous page",
        "next": "link of the next page"
    },
    "meta": {
        "current_page": "the current page number",
        "per_page": "number of items per page",
        "total": "total number of items"
    }
}
```
---