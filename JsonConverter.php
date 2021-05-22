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
    private $data;

    private $mode;

    private $depth;

    private $hyphenation;

    /**
     * @param string|object|array $data
     * @param int $mode
     * @param int $depth
     * @param string $hyphenation
     */
    public function __construct($data, $mode = 0, $depth = 0, $hyphenation = null)
    {
        if (is_string($data)) {
            $this->data = json_decode($data);
        } else if (!is_resource($data)) {
            $this->data = $data;
        }
        $this->mode = $mode;
        $this->depth = $depth;
        $this->hyphenation = $hyphenation;
    }

    /**
     * @return false|string
     */
    public function get()
    {
        return $this->data !== false && $this->data !== null ? $this->getConvertedData($this->data) : false;
    }

    /**
     * @param array|object $data
     * @return false|string
     */
    private function getConvertedData($data)
    {
        ob_start();
        if ($this->depth) {
            echo json_encode($data, $this->mode | JSON_PRETTY_PRINT, $this->depth);
        } else {
            echo json_encode($data, $this->mode | JSON_PRETTY_PRINT);
        }
        $result = ob_get_contents();
        ob_end_clean();

        if(!is_null($this->hyphenation)){
            $result = $this->createHyphenation($result);
        }
        return $result;
    }

    /**
     * @param $str
     * @return string
     */
    private function createHyphenation($str) {
        return str_replace("\n", $this->hyphenation, $str);
    }
}

