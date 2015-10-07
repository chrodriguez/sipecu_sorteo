<?php
function __autoload($name) {
    $new_name = strtolower(array_pop(explode("\\",$name)));
    $file = "$new_name.php";
    if ( file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.$file)) include $file;
}
