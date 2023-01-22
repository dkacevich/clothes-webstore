<?php

namespace System;

class StringHelper {

    public static function namespaceToPath(string $str): string {
        return str_replace("\\", '/', $str) . '.php';
    }
}
