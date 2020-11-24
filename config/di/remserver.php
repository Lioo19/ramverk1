<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "remserver" => [
            "shared" => true,
            "callback" => function () {
                $rem = new \Anax\RemServer\RemServer();
                $rem->injectSession($this->get("session"));

                // Load the configuration file
                $cfg = $this->get("configuration");
                $config = $cfg->load("remserver/config.php");
                $configFile = $config["file"] ?? null;

                $dataset = $config["config"]["dataset"] ?? null;
                if (!$dataset) {
                    throw new Exception("Configuration file '$configFile' is missing an entry 'dataset'.");
                }

                $rem->setDefaultDataset($dataset);
                return $rem;
            }
        ],
    ],
];
