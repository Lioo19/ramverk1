<?php

namespace Lioo19\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Lioo19\Models\GeoMap;
use Lioo19\Models\Weather;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class WeatherJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexActionGet() : array
    {
        $request = $this->di->get("request");
        //request to get GET-info
        $userip = $request->getGet("ip", null);
        $userlon = $request->getGet("lon", null);
        $userlat = $request->getGet("lat", null);

        if ($userip) {
            $data = $this->getIpData($userip);
        } elseif ($userlon && $userlat) {
            $data = $this->getPosData($userlon, $userlat);
        } else {
            $data = [
                "message" => "Inkorrekt värde angivet"
            ];
        }
        return [$data];
    }

    public function getGeo($userip)
    {
        $geo = $this->di->get("ipgeo");
        $geo->setInput($userip);
        $geoInfo = $geo->fetchGeo();

        return $geoInfo;
    }

    public function getWeather($which, $userlon, $userlat)
    {
        if ($which == "forecast") {
            $weather = new Weather();
            $forweather = $weather->fetchForecastWeather($userlon, $userlat);
            return $forweather;
        } else {
            $weather = new Weather();
            $histweather = $weather->fetchHistoricalWeather($userlon, $userlat);
            return $histweather;
        }
    }

    private function getIPData($userip)
    {
        $validation = $this->di->get("iptest");
        $validation->setInput($userip);

        $ip4 = $validation->ip4test();
        $ip6 = $validation->ip6test();

        if ($ip6 || $ip4) {
            $hostname = gethostbyaddr($userip);
            $geoInfo = $this->getGeo($userip);
            $lon = $geoInfo["longitude"];
            $lat = $geoInfo["latitude"];
            $forweather = $this->getWeather("forecast", $lon, $lat);
            $histweather = $this->getWeather("historical", $lon, $lat);
        } else {
            $data = [
                "message" => "Inkorrekt IP, prova igen",
            ];

            return $data;
        }

        $data = [
            "ip" => $userip,
            "hostname" => $hostname,
            "geoInfo" => $geoInfo,
            "weathertoday" => [
                "description" => $forweather["current"]["weather"][0]["description"],
                "temp" => number_format($forweather["current"]["temp"], 2),
                "feels_like" => number_format($forweather["current"]["feels_like"], 2)
                ],
            "forecast" => [
                "tomorrow" => [
                    "description" => $forweather["daily"][0]["weather"][0]["description"],
                    "temp" => number_format($forweather["daily"][0]["temp"]["day"], 2),
                    "feels_like" => number_format($forweather["daily"][0]["feels_like"]["day"], 2)
                ],
                "in_2_days" => [
                    "description" => $forweather["daily"][1]["weather"][0]["description"],
                    "temp" => number_format($forweather["daily"][1]["temp"]["day"], 2),
                    "feels_like" => number_format($forweather["daily"][1]["feels_like"]["day"], 2)
                ],
                "in_3_days" => [
                    "description" => $forweather["daily"][2]["weather"][0]["description"],
                    "temp" => number_format($forweather["daily"][2]["temp"]["day"], 2),
                    "feels_like" => number_format($forweather["daily"][2]["feels_like"]["day"], 2)
                ],
                "in_4_days" => [
                    "description" => $forweather["daily"][3]["weather"][0]["description"],
                    "temp" => number_format($forweather["daily"][3]["temp"]["day"], 2),
                    "feels_like" => number_format($forweather["daily"][3]["feels_like"]["day"], 2)
                ],
                "in_5_days" => [
                    "description" => $forweather["daily"][4]["weather"][0]["description"],
                    "temp" => number_format($forweather["daily"][4]["temp"]["day"], 2),
                    "feels_like" => number_format($forweather["daily"][4]["feels_like"]["day"], 2)
                ],
            ],
            "histweather" => [
                "yesterday" => [
                    "description" => $histweather[0]["weather"][0]["description"],
                    "temp" => number_format($histweather[0]["temp"], 2),
                    "feels_like" => number_format($histweather[0]["feels_like"], 2)
                ],
                "two_days_ago" => [
                    "description" => $histweather[1]["weather"][0]["description"],
                    "temp" => number_format($histweather[1]["temp"], 2),
                    "feels_like" => number_format($histweather[1]["feels_like"], 2)
                ],
                "three_days_ago" => [
                    "description" => $histweather[2]["weather"][0]["description"],
                    "temp" => number_format($histweather[2]["temp"], 2),
                    "feels_like" => number_format($histweather[2]["feels_like"], 2)
                ],
                "four_days_ago" => [
                    "description" => $histweather[3]["weather"][0]["description"],
                    "temp" => number_format($histweather[3]["temp"], 2),
                    "feels_like" => number_format($histweather[3]["feels_like"], 2)
                ],
                "five_days_ago" => [
                    "description" => $histweather[4]["weather"][0]["description"],
                    "temp" => number_format($histweather[4]["temp"], 2),
                    "feels_like" => number_format($histweather[4]["feels_like"], 2)
                ]
            ]
        ];

        return $data;
    }

    private function getPosData($userlon, $userlat)
    {
        //check that lon/lat are valid floats
        if (floatval($userlon) != 0 && floatval($userlat) != 0) {
            $forweather = $this->getWeather("forecast", $userlon, $userlat);
            $histweather = $this->getWeather("historical", $userlon, $userlat);
            if (is_array($forweather) && array_key_exists("current", $forweather)) {
                $data = [
                    "lon" => $userlon,
                    "lat" => $userlat,
                    // "whole" => $forweather,
                    "weathertoday" => [
                        "description" => $forweather["current"]["weather"][0]["description"],
                        "temp" => number_format($forweather["current"]["temp"], 2),
                        "feels_like" => number_format($forweather["current"]["feels_like"], 2)
                        ],
                    "forecast" => [
                        "tomorrow" => [
                            "description" => $forweather["daily"][0]["weather"][0]["description"],
                            "temp" => number_format($forweather["daily"][0]["temp"]["day"], 2),
                            "feels_like" => number_format($forweather["daily"][0]["feels_like"]["day"], 2)
                        ],
                        "in_2_days" => [
                            "description" => $forweather["daily"][1]["weather"][0]["description"],
                            "temp" => number_format($forweather["daily"][1]["temp"]["day"], 2),
                            "feels_like" => number_format($forweather["daily"][1]["feels_like"]["day"], 2)
                        ],
                        "in_3_days" => [
                            "description" => $forweather["daily"][2]["weather"][0]["description"],
                            "temp" => number_format($forweather["daily"][2]["temp"]["day"], 2),
                            "feels_like" => number_format($forweather["daily"][2]["feels_like"]["day"], 2)
                        ],
                        "in_4_days" => [
                            "description" => $forweather["daily"][3]["weather"][0]["description"],
                            "temp" => number_format($forweather["daily"][3]["temp"]["day"], 2),
                            "feels_like" => number_format($forweather["daily"][3]["feels_like"]["day"], 2)
                        ],
                        "in_5_days" => [
                            "description" => $forweather["daily"][4]["weather"][0]["description"],
                            "temp" => number_format($forweather["daily"][4]["temp"]["day"], 2),
                            "feels_like" => number_format($forweather["daily"][4]["feels_like"]["day"], 2)
                        ],
                    ],
                    "histweather" => [
                        "yesterday" => [
                            "description" => $histweather[0]["weather"][0]["description"],
                            "temp" => number_format($histweather[0]["temp"], 2),
                            "feels_like" => number_format($histweather[0]["feels_like"], 2)
                        ],
                        "two_days_ago" => [
                            "description" => $histweather[1]["weather"][0]["description"],
                            "temp" => number_format($histweather[1]["temp"], 2),
                            "feels_like" => number_format($histweather[1]["feels_like"], 2)
                        ],
                        "three_days_ago" => [
                            "description" => $histweather[2]["weather"][0]["description"],
                            "temp" => number_format($histweather[2]["temp"], 2),
                            "feels_like" => number_format($histweather[2]["feels_like"], 2)
                        ],
                        "four_days_ago" => [
                            "description" => $histweather[3]["weather"][0]["description"],
                            "temp" => number_format($histweather[3]["temp"], 2),
                            "feels_like" => number_format($histweather[3]["feels_like"], 2)
                        ],
                        "five_days_ago" => [
                            "description" => $histweather[4]["weather"][0]["description"],
                            "temp" => number_format($histweather[4]["temp"], 2),
                            "feels_like" => number_format($histweather[4]["feels_like"], 2)
                        ]
                    ]
                ];

                return $data;
            } else {
                $data = [
                    "message" => "Inkorrekt position, prova igen",
                ];

                return $data;
            }
        } else {
            $data = [
                "message" => "Inkorrekt position, prova igen",
            ];

            return $data;
        }
    }
}
