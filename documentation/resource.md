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
### Sell resources
Sell resources. We will only sell the resources that the user has. For example, if the user wants to sell 2 kg of stones but only has 1 kg, we will sell 1 kg of stones and not 2 kg.  
**Method :** PATCH  
**Route :** /sell  
**Payload :**
```json
{
    "resources": [
        {
            "resource_id": "id of the resource to sell",
            "quantity": "quantity to sell in kg"
        }
        ...
    ]
}
```  
**Return :**  
```json
{
    "selled_resources": [
        {
            "id": "id of the selled resource",
            "name": "name of the selled resource",
            "quantity": "selled quantity"
        }
        ...
    ],
    "money": "earned money"
}
```
---