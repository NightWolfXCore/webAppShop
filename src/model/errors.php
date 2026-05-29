<?php

namespace Model;

use Exception;

class Errors
{
    private string $errorsPath = __DIR__ . "/../../assets/json/errors.json";
    private ?array $errorsList = null;

    public function __construct()
    {
        $errorsJSON = file_get_contents($this->errorsPath);
        $errorsArray = json_decode($errorsJSON, true);
        foreach ($errorsArray as $key => $value) {
            $this->errorsList[] = [
                "errorCode" => (int)$key,
                "errorTitle" => $value["errorTitle"],
                "errorDescription" => $value["errorDescription"]
            ];
        }
    }

    public function getError(): array|bool|null
    {
        $result = null;
        $error = false;
        try {
            $codeStatus = http_response_code();
            foreach ($this->errorsList as $variable) {
                if ($codeStatus === $variable["errorCode"]) {
                    $error = $variable;
                    break;
                }
            }
            if (!$error) 
                throw new Exception("Ошибка получения ошибки xD");
            return $error;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function setCode(int $code): bool|null
    {
        $result = null;
        try {
            $result = http_response_code($code);
            if (!$result) 
                throw new Exception("Ошибка установки ошибки xD");
            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
