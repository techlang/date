<?php
/**
 * @author Ionut DINU
 * @date 12/06/2014
 */

error_reporting(E_ALL | E_STRICT);

$dir = dirname(__FILE__);
$found = false;
while (!$found) {
    $file = $dir . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
    if (!file_exists($file)) {
        $dir = dirname($dir);
        continue;
    }

    /** @var \Composer\Autoload\ClassLoader $loader */
    $loader = include $file;
    $found = true;
}
