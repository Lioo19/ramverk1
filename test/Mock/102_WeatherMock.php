<?php
namespace Lioo19\Models;

/**
 * Class for mocking Weather
 * Class only contain methods for checking
 *
 */
class WeatherMock extends Weather
{
    /**
    * Class for mocking request to forecast
    *
    */
    public function fetchForecastWeather($lon, $lat, $url = "khrfkjn")
    {
        if (strlen($lon) > 0 && strlen($lat) > 0) {
            $data = [
                "current" => [
                    "dt" => "1606129253",
                    "temp" => "9.31",
                    "feels_like" => "9.31",
                    "weather" => [
                        [
                            "description" => "molnigt"
                        ]
                    ]
                ],
                "daily" => [
                    [
                        "temp" => [
                            "day" => "9.31"
                            ],
                        "feels_like" => [
                            "day" => "9.31",
                        ],
                        "weather" => [
                            [
                                "description" => "molnigt"
                            ]
                        ]
                    ],
                    [
                        "temp" => [
                            "day" => "9.31"
                            ],
                        "feels_like" => [
                            "day" => "9.31",
                        ],
                        "weather" => [
                            [
                                "description" => "molnigt"
                            ]
                        ]
                    ],
                    [
                        "temp" => [
                            "day" => "9.31"
                            ],
                        "feels_like" => [
                            "day" => "9.31",
                        ],
                        "weather" => [
                            [
                                "description" => "molnigt"
                            ]
                        ]
                    ],
                    [
                        "temp" => [
                            "day" => "9.31"
                            ],
                        "feels_like" => [
                            "day" => "9.31",
                        ],
                        "weather" => [
                            [
                                "description" => "molnigt"
                            ]
                        ]
                    ],
                    [
                        "temp" => [
                            "day" => "9.31"
                            ],
                        "feels_like" => [
                            "day" => "9.31",
                        ],
                        "weather" => [
                            [
                                "description" => "molnigt"
                            ]
                        ]
                    ],
                ],
                "city" => "Karlskrona",
                "lat" => "56.16122055053711",
                "lon" => "15.586899757385254",
            ];
        }

        return $data;
    }


    /**
    * Class for mocking request to historical
    *
    */
    public function fetchHistoricalWeather($lon, $lat)
    {
        if (strlen($lon) > 0 && strlen($lat) > 0) {
            $data = [
                [
                    "weather" => [
                        [
                            "description" => "molnigt"
                        ],
                    ],
                    "temp" => "9.31",
                    "feels_like" => "9.31"
                ],
                [
                    "weather" => [
                        [
                            "description" => "molnigt"
                        ],
                    ],
                    "temp" => "9.31",
                    "feels_like" => "9.31"
                ],
                [
                    "weather" => [
                        [
                            "description" => "molnigt"
                        ],
                    ],
                    "temp" => "9.31",
                    "feels_like" => "9.31"
                ],
                [
                    "weather" => [
                        [
                            "description" => "molnigt"
                        ],
                    ],
                    "temp" => "9.31",
                    "feels_like" => "9.31"
                ],
                [
                    "weather" => [
                        [
                            "description" => "molnigt"
                        ],
                    ],
                    "temp" => "9.31",
                    "feels_like" => "9.31"
                ],
            ];
        } else {
            $data = [
                [
                    "message" => "Inkorrekt position, prova igen",
                ]
            ];
        }
        return $data;
    }
}
