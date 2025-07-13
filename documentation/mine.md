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
---
### Start mine processing
This route start a mine processing  
**Method :** PATCH  
**Route :** /{mine_id}/process  
**Payload :**
```json
{
    "resource_id": "required | exsits in database | the mine is at enough high level to mine this resource"
}
```
**Return :**
```json
{
    "id": "id of the mine",
    "level": "level of the mine",
    "startedAt": "Datetime of the process start",
    "resource": {
        "id": "id of the resource",
        "name": "name of the resource"
    }
}
```