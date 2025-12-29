<?php

namespace App\Enums;

enum MafiaTargetType: string
{
    case USER = "user";
    case COMPANY = "company";
    case BANK_ACCOUNT = "bankAccount";
    case HOME = "home";
    case CYBERATTACK = "cyberattack";
    case USER_DRONE = "userDrone";
    case HOME_DRONE = "homeDrone";
    case SHOPLIFTING = "shopping";
    case PHISHING = "phishing";
}
