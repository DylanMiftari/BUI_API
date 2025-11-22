## Documentation for casino route (/api/casino)

### Get all casino tickets of the user
This route return all (non expired) casino tickets of the user 
**Method :** GET  
**Route :** /tickets  
**Return :**
```json
[
    {
        "id": "ticket id",
        "isVIP": "boolean to indicate if the ticket is a vip ticket",
        "createdAt": "The buy date of the ticket",
        "casino": {
            "id": "id of the casino",
            "company": {
                "id": "id of the company",
                "name": "name of the casino",
                "type": "casino",
                "activated": 1,
                "level": "level of the company"
            }
        }
    },
    ...
]
```
---

### Buy a ticket
This route buy a ticket for a user  
**Method :** POST  
**Route :** /{casino}/buy  
**Payload :**
```json
{
    "isVIP": "boolean indicate if the bought ticket is VIP"
}
```
**Return :**
```json
{
    "id": "ticket id",
    "isVIP": "boolean to indicate if the ticket is a vip ticket",
    "createdAt": "The buy date of the ticket",
    "casino": {
        "id": "id of the casino",
        "company": {
            "id": "id of the company",
            "name": "name of the casino",
            "type": "casino",
            "activated": 1,
            "level": "level of the company"
        }
    }
}
```
---

## Play at roulette
This route launch a game roulette  
**Method :** POST  
**Route :** /{casino}/game/roulette  
**Payload :**
```json
{
    "bet": "the user bet"
}
```
**Return :**
```json
{
    "bet": "the user bet",
    "winnings": "the user winnings",
    "roll": "the result (e.g. 513)"
}
```
---

## Play at dice
This route launch a game dice  
**Method :** POST  
**Route :** /{casino}/game/dice  
**Payload :**
```json
{
    "bet": "the user bet"
}
```
**Return :**
```json
{
    "bet": "the user bet",
    "winnings": "the user winnings",
    "roll": [
        "result of dice 1",
        "result of dice 2"
    ],
    "sum": "sum of two dices"
}
```
---

## Play at poker
This route launch a game poker  
**Method :** POST  
**Route :** /{casino}/game/poker  
**Payload :**
```json
{
    "bet": 100
}
```
**Return :**
```json
{
    "bet": "the user bet",
    "winnings": "the user winnings",
    "hand": "the hand of the user",
    "cards": [
        {
            "color": "color of the first card",
            "value": "value of the first card"
        },
        ...
    ]
}
```
---

## Create blackjack party
This route create a blackjack party  
**Method :** POST  
**Route :** /{casino}/game/blackjack/init  
**Payload :**
```json
{
    "bet": 100
}
```
**Return :**
```json
{
    "id": "id of the party",
    "userHand": [
        {
            "color": "color of the first card",
            "value": "value of the first card"
        },
        {
            "color": "color of the second card",
            "value": "value of the second card"
        }
    ],
    "bankHand": [
        {
            "color": "color of the first card",
            "value": "value of the first card"
        }
    ],
    "bet": "bet of the user"
}
```
---

## Hit card in blackjack party
This route create a blackjack party  
**Method :** PATCH  
**Route :** /{casino}/game/blackjack/{blackjack_party}/hit
**Return :**
```json
{
    "id": "id of the party",
    "userHand": [
        {
            "color": "color of the card",
            "value": "value of the card"
        },
        ...
    ],
    "bankHand": [
        {
            "color": "color of the first card",
            "value": "value of the first card"
        }
    ],
    "bet": "bet of the user"
}
```
---

## Play roulette2 party
Play a roulette2 party  
**Method :** POST  
**Route :** /{casino}/game/roulette2
**Payload :**
```json
{
    "bet": { // All objects are facultative
        "straight_up": {
            "number": "number 0-36",
            "bet": "the user bet"
        },
        "split": {
            "numbers": "a list with two numbers",
            "bet": "the user bet"
        },
        "street": {
            "numbers": "a list with three numbers",
            "bet": "the user bet"
        },
        "corner": {
            "numbers": "a list with 4 numbers",
            "bet": "the user bet"
        },
        "sixline": {
            "numbers": "a list with 6 numbers",
            "bet": "the user bet"
        },
        "column": {
            "column_number": "a column number 0, 1 or 2",
            "bet": "the user bet"
        },
        "dozen": {
            "dozen_number": "a dozen number 0, 1 or 2",
            "bet": "the user bet"
        },
        "middle": {
            "part_number": "middle number 0 or 1",
            "bet": "the user bet"
        },
        "red_black": {
            "bet_name": "the color red or black",
            "bet": "the user bet"
        },
        "odd_even": {
            "bet_name": "the user choice : odd or even",
            "bet": "the user bet"
        }
    }
}
```
**Return :**
```json
{
    "bet": "the total user bet",
    "winnings": "the total user winnings",
    "res": [
        "list of successfully bet of the user"
    ],
    "roll": "the rolled number"
}
```
