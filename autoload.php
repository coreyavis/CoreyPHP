<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		Autoload
 * @file		autoload.php
 * ---------------------------------------------------------------------*/

/* ----------------------------------------------------------------------
 * CoreyPHP::autoload()
 *
 * @return NULL
 * ----------------------------------------------------------------------*/
spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
    if (strncmp('Corey', $className, 5) != 0) return;
    $file = $baseDir . $className . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
});

?>
