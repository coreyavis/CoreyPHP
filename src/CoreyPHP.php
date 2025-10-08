<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreyPHP
 * @file		CoreyPHP.php
 * ---------------------------------------------------------------------*/

class CoreyPHP {
    
    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Config Variables
	 * ----------------------------------------------------------------------*/
	private array $defaults = [];
	private array $config = [];
    
    /* ----------------------------------------------------------------------
	 * Developer Config
	 * ----------------------------------------------------------------------*/
    private $debug = true; // NOTE: Change to false for live sites.
    
    /* ----------------------------------------------------------------------
	 * Constants / Regular Expressions - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::__construct()
	 * 
	 * @param array $config - Config options (optional)
	 * @return NULL
	 * ----------------------------------------------------------------------*/
    public function __construct(array $config = []) {
		//set_error_handler(['Errors', 'errorMsg']);
		//set_exception_handler(['Errors', 'exceptionMsg']);
	}
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::config()
	 * 
	 * @param mixed $config - Config options in array or config key for key/value pair
	 * @param mixed $arg - Config value for key/value pair
	 * @return object $this
	 * ----------------------------------------------------------------------*/
	public function config() {
		return 'This works.';
	}
    
}

?>
