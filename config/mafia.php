<?php

return [
    "player" => [
        "costByLevel" => [
            1 => 2_000,
            2 => 4_000,
            3 => 6_000,
            4 => 10_000,
            5 => 12_500,
            6 => 15_000
        ],
        "baseSuccessRate" => 35,
        "successRateByLevel" => 10,
        "stealValue" => [
            "min" => 70,
            "max" => 95,
            "byLevel" => 2
        ]
    ],
    "company" => [
        "costByLevel" => [
            1 => 10_000,
            2 => 45_000,
            3 => 80_000,
            4 => 225_000,
            5 => 850_000,
            6 => 1_500_000
        ],
        "baseSuccessRate" => 20,
        "successRateByLevel" => 10,
        "stealValue" => [
            "min" => 30,
            "max" => 50,
            "byLevel" => 10,
            "limit" => 1_000_000
        ],
        "cooldownInDays" => 3
    ],
    "bankAccount" => [
        "costByLevel" => [
            1 => 5_000,
            2 => 7_500,
            3 => 10_000,
            4 => 20_000,
            5 => 50_000,
            6 => 85_000
        ],
        "baseSuccessRate" => 10,
        "successRateByLevel" => 5,
        "stealValue" => [
            "min" => 10,
            "max" => 20,
            "byLevel" => 5,
            "limit" => 500_000
        ],
        "cooldownInDays" => 2
    ],
    "house" => [
        "costByLevel" => [
            1 => 500,
            2 => 750,
            3 => 1_000,
            4 => 1_500,
            5 => 2_000,
            6 => 2_250
        ],
        "baseSuccessRate" => 5,
        "successRateByLevel" => 1,
        "stealValue" => [
            "min" => 80,
            "max" => 90,
            "byLevel" => 1,
        ]
    ],
    "cyberattack" => [
        "minLevelOfMafia" => 3,
        "cost" => 5_000,
        "successRate" => 50,
        "stealValue" => 15_000
    ],
    "aiDrone" => [
        "minLevelOfMafia" => 4,
        "cost" => 5_000,
        "successRate" => [
            "player" => 100,
            "house" => 25
        ],
        "stealValue" => [
            "min" => 85,
            "max" => 100
        ]
    ],
    "shoplifting" => [
        "minLevelOfMafia" => 5,
        "cost" => 1_000,
        "successRate" => 75,
        "stealValue" => [
            "min" => 250,
            "max" => 1_500
        ]
    ],
    "phishing" => [
        "minLevelOfMafia" => 6,
        "cost" => 30_000,
        "successRate" => 1,
        "stealValue" => 50
    ]
];
