## Documentation for mine route (/api/mine)

### Get all user's mines
This route return all user's mines
**Method :** GET  
**Route :** /  
**Query params :**
- with=value1,value2...
- mineable_at=[1-6] : Get resources mineable with a specific mine level

**Return :**  
```json
[
    {
        "id": "id of the resource",
        "name": "name of the resource",
        "price": "price for 0.1kg of the resource"
    },
    ...
]
```
---