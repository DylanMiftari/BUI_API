<?php

namespace App\Enums;

enum MafiaContractStatus: string
{
    case WAIT_ON_MAFIA = "wait_on_mafia";
    case WAIT_ON_CLIENT = "wait_on_client";
    case FINISHED = "finished";
}
