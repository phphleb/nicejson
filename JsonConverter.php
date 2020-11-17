<?php

/**
 * @author  Foma Tuturov <fomiash@yandex.ru>
 *
 * Convert json to readable form.
 * Преобразование json-строки в читаемый вид.
 */

/*
convert
'{"example":["first","second"]}'
to
'{
    "example": [
        "first",
        "second"
    ]
}'
 */

namespace Phphleb\Nicejson;


class JsonConverter
{
    private $json;

    private $mode;

    /**
     * @param string|object|array $resource
     * @param int $mode
     */
    public function __construct($resource, $mode = 0) {
        $this->json = is_string($resource) ? json_decode($resource) : $resource;
        $this->mode = $mode;
    }

    /**
     * @return false|string
     */
    public function get() {
        return $this->toReadingStrings($this->json);
    }

    private function toReadingStrings($data) {
        ob_start();
        echo json_encode($data, $this->mode | JSON_PRETTY_PRINT);
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}

