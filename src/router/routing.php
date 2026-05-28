<?php

namespace router;

class Routing
{
    public static ?array $list = null;

    public static function getMethod(string $URL, string $namepage)
    {
        self::$list[] = [
            "url" => $URL,
            "namepage" => $namepage
        ];
    }
    public static function postMethod(string $URL, object $objClass, string $method, ?array $data = [])
    {
        self::$list[] = [
            "url" => $URL,
            "objClass" => $objClass,
            "method" => $method,
            "data" => $data
        ];
    }
    public static function action()
    {
        $routing = $_GET["routing"] ?? "";
        foreach (self::$list as $variable) {
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                if ($variable["url"] === "/" . $routing) {
                    include sprintf("src/view/pages/%s.php", $variable["namepage"]);
                    die();
                }
            }
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if ($variable["url"] === "/" . $routing) {
                    $objClass = $variable["objClass"];
                    $method = $variable["method"];
                    $data = $variable["data"];

                    $result = $objClass->$method($data);

                    $returnTo = $data["_returnTo"] ?? ($_SERVER["HTTP_REFERER"] ?? "/");
                    header("Location: " . $returnTo);
                    die();
                }
            }
        }
    }
}
