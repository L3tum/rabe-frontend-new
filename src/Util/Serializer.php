<?php

namespace RaBe\Util;

/**
 * Class Serializer
 */
class Serializer
{
    /**
     * @param string|object $json
     * @param string $className
     * @return object
     */
    public static function deserialize($json, string $className)
    {
        // LOL WTF PHP
        if (is_string($json)) {
            $json = json_decode($json);  //JSON to stdClass
        }

        $temp = serialize($json);          //stdClass to serialized

        // Now we reach in and change the class of the serialized object
        $temp = preg_replace('@^O:8:"stdClass":@', 'O:' . strlen($className) . ':"' . $className . '":', $temp);

        // Unserialize and walk away like nothing happened
        return unserialize($temp);   // Presto a php Class
    }

    /**
     * @param string $json
     * @param string $className
     * @return array
     */
    public static function deserializeArray(string $json, string $className)
    {
        $json = json_decode($json);
        $items = [];

        foreach ($json as $item) {
            $items[] = self::deserialize($item, $className);
        }

        return $items;
    }
}
