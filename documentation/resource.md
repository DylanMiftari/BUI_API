## Documentation for resource route (/api/resource)

### Get all resources
This route return all resources
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