## Documentation for mine route (/mine)

### RGet all user's mines
This route return all user's mines
**Method :** GET  
**Route :** /  
**Return :**  
```json
[
    {
        "id": "id of the mine",
        "level": "level of the mine",
        "startedAt": "the date of mining started",
        "resource": { // The mined resource
            "id": "id of the resource",
            "name": "name of the resource"
        }
    }
    ...
]
```
---