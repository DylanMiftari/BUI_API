## Documentation for company route (/api)

### Register
This route create a user and return a bearer token
**Method :** POST  
**Route :** /register  
**Payload :**
```json
{
    "pseudo": "required | not empty | max length : 100 | unique in DB",
    "password": "required | not empty",
    "password_confirmation": "required | same as password field"
}
```
**Return :**  
The created user and his token
```json
{
    "user": {
        "pseudo": "pseudo of user",
        "updated_at": "the last update date of the user",
        "created_at": "the creation date of the user",
        "id": "id of the user"
    },
    "token": "his bearer token"
}
```
---
### Login
This route check password and give a new bearer token if it's valid
**Method :** POST  
**Route :** /login  
**Payload :**
```json
{
    "pseudo": "required | not empty | max length : 100 | unique in DB",
    "password": "required | not empty"
}
```
**Return :**  
The user and his token
```json
{
    "user": {
        "id": "id of the user",
        "pseudo": "pseudo of the user",
        "playerMoney": "the money of the player",
        "city_id": "the city id of the user",
        "inTravel": "boolean indicate if the user is in travel",
        "endTravel": "the date of the end of the user travel. null if he is not in travel",
        "created_at": "the last update date of the user",
        "updated_at": "the creation date of the user"
    },
    "token": "his bearer token"
}
```

---
### Get current user
This route return the data of the currently logged user
**Method :** GET  
**Route :** /me  
**Query params :**
- with=value1,value2...

**Return :**  
The currently logged user
```json
{
    "id": "id of the user",
    "pseudo": "pseudo of the user",
    "userMoney": "user money of the user", // if "userMoney" is present in with param
    "companies": [ // if "company" is present in with param
        {
            "id": "id of the company",
            "name": "name of the company",
            "type": "type of the company",
            "activated": "boolean indicate if company is activated"
        },
        ...
    ],
    "mines": [ // if "mine" is present in with param
        {
            "id": "id of the mine",
            "level": "level of the mine"
        }
        ...
    ]
}
```