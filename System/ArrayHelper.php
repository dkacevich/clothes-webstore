<?php 


namespace System;

class ArrayHelper {
    
    public static function changeArrKeys(array &$source, array $fields) {
        foreach($fields as $key => $newKey) {
            if (array_key_exists($key, $source)) {
                $source[$newKey] = $source[$key];
                unset($source[$key]);
            }
        }
    }

    public static function extractFields(array $target, array $fields) : array{
		$res = [];

		foreach($fields as $field){
            if (empty($target[$field])) {
                $res[$field] = null;
                continue;
            }

			$res[$field] = trim($target[$field]);
		}

		return $res;
	}


    public static function htmlChars(array $array) : array {
        $res = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $res[$key] = self::htmlChars($value);
                continue;
            }

            $safeKey = htmlspecialchars($key);
            $safeValue = htmlspecialchars($value);

            $res[$safeKey] = $safeValue;
        }

        return $res;
    }
}