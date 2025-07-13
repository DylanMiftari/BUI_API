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
### Upgrade a mine
This route upgrade a mine. Player must have enough money to upgrade his mine. You can't upgrade a mine, which is already at the maximum level.  
**Method :** PATCH  
**Route :** /{mine_id}/upgrade  
**Return :**
```json
{
    "result": true // If the upgrade has correctly done
}
```