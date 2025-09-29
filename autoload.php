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
    if (strncmp('Corey', $className, 5) === 0) {
        $coreFile = $baseDir . 'CoreyPHP.php';
        if (!file_exists($coreFile)) {
            die(sprintf(
                "<h3>CoreyPHP Framework Error</h3>" .
                "<p><strong>Fatal Error:</strong> The core library dependancy file is missing.</p>" .
                "<p>The file <code>%s</code> is required for this component to run.</p>" .
                "<p>Please ensure you have uploaded the base <code>CoreyPHP.php</code> file into your src/ directory.</p>",
                htmlspecialchars($coreFile)
            ));
        }
        $file = $baseDir . $className . '.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }
});

?>
