NICEJSON
=====================

###  Convert json to readable form
###   Преобразование json-строки в читаемый вид

 Install using Composer:
 ```bash
 $ composer require phphleb/nicejson
 ```
-----------------------------------------

Convert
 ```json
{"example":["first","second"]}
 ```
to
 ```json
{
    "example": [
        "first",
        "second"
    ]
}
 ```

 ```php
$data = '{"example":["first","second"]}'; // string json
file_put_contents('/path/to/result/json/file/', (new \Phphleb\Nicejson\JsonConverter($data))->get());
 ```
or

 ```php
$data = ["example"=>["first","second"]]; // array
file_put_contents('/path/to/result/json/file/', (new \Phphleb\Nicejson\JsonConverter($data))->get());
 ```
or

 ```php
$data = (object) ["example"=>["first","second"]]; // object
file_put_contents('/path/to/result/json/file/', (new \Phphleb\Nicejson\JsonConverter($data))->get());
 ```

add flag to json_encode(...)

 ```php
use Phphleb\Nicejson\JsonConverter;
$jsonConverterObject = new JsonConverter($data, JSON_FORCE_OBJECT);
 ```
