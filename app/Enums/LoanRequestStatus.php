<?php

namespace App\Enums;

enum LoanRequestStatus: string
{
    case WAIT_ON_BANK = "wait on bank";
    case WAIT_ON_CLIENT = "wait on client";
    case DENY = "deny";
    case APPROVED = "approved";
    case CANCELED = "canceled";
    case PAYING = "paying";
    case PAYED = "payed";
}
