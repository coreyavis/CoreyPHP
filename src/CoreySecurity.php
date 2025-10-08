<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreySecurity
 * @file		CoreySecurity.php
 * ---------------------------------------------------------------------*/

class CoreySecurity {
    
    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Config Variables - Defaults
	 * ----------------------------------------------------------------------*/
	private array $defaults = [
        'hash' => 'sha256',
    ];
	private array $config = [];
    
    /* ----------------------------------------------------------------------
	 * Developer Config
	 * ----------------------------------------------------------------------*/
    private $debug = true; // NOTE: Change to false for live sites.
    
    /* ----------------------------------------------------------------------
	 * Constants / Regular Expressions - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    
    /* ----------------------------------------------------------------------
	 * Security::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * @return NULL
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		
	}
    
    /* ----------------------------------------------------------------------
	 * Security::config()
	 * 
	 * @param mixed $config - Config options in array or config key for key/value pair
	 * @param mixed $arg - Config value for key/value pair
	 * @return object $this
	 * ----------------------------------------------------------------------*/
	public function config() {
		
	}
    
}

?>
