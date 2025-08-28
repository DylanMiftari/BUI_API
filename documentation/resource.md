## Documentation for resource route (/api/resource)

### Get all resources
This route return all resources  
**Method :** GET  
**Route :** /  
**Return :**  
```json
[
    {
        "id": "id of the resource",
        "name": "name of the resource",
        "timeToMine": "time to mine the resource",
        "mineQuantity": "mined quantity"
    },
    ...
]
```
---
### Get resources of user
This route return all resources of the user  
**Method :** GET  
**Route :** /my  
**Return :**
```json
[
    {
        "resource": {
            "id": "id of the resource",
            "name": "name of the resource",
            "price": "price for 0.1kg of the resource",
            "timeToMine": "time to mine resource in min",
            "mineQuantity": "quantity of one mining operation"
        },
        "quantity": "quantity owned by the user"
    },
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
