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
                "message" => "Inget korrekt värde angivet"
            ];
        }
        return [$data];
    }

    private function getIPData($userip) {
        $validation = $this->di->get("iptest");
        $validation->setInput($userip);

        $ip4 = $validation->ip4test();
        $ip6 = $validation->ip6test();

        if ($ip6 || $ip4) {
            $hostname = gethostbyaddr($userip);
            $geo = $this->di->get("ipgeo");
            $geo->setInput($userip);
            $geoInfo = $geo->fetchGeo();
            $lon = $geoInfo["longitude"];
            $lat = $geoInfo["latitude"];
            $weather = new Weather();
            $currweather = $weather->fetchCurrentWeather($lon, $lat);
            $histweather = $weather->fetchHistoricalWeather($lon, $lat);
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
                "description" => $currweather["description"],
                "temp" => number_format($currweather["temp"], 2),
                "feels_like" => number_format($currweather["feels_like"], 2)
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

    private function getPosData($userlon, $userlat) {
        //check that lon/lat are valid floats
        if (floatval($userlon) != 0 && floatval($userlat) != 0) {
            $weather = new Weather();
            $currweather = $weather->fetchCurrentWeather($userlon, $userlat);
            $histweather = $weather->fetchHistoricalWeather($userlon, $userlat);
            if (array_key_exists("main", $currweather)) {
                $data = [
                    "lon" => $userlon,
                    "lat" => $userlat,
                    "weathertoday" => [
                        "description" => $currweather["description"],
                        "temp" => number_format($currweather["temp"], 2),
                        "feels_like" => number_format($currweather["feels_like"], 2)
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
