<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreyHTML
 * @file		CoreyHTML.php
 * ---------------------------------------------------------------------*/

class CoreyHTML {
    
    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Config Variables - Defaults
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
	 * CoreyHTML::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * @return NULL
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		$this->setConfig($userConfig);
	}

	/* ----------------------------------------------------------------------
	 * CoreyHTML::setConfig()
	 * 
	 * @param mixed $userConfig - Config options in array or config key for key/value pair
	 * @param mixed $arg - Config value for key/value pair
	 * @return bool true
	 * ----------------------------------------------------------------------*/
	// TODO: Add key/value option.
	public function setConfig(array $userConfig = []) {
		$this->config = array_merge($this->defaults, $userConfig);
		return true;
	}

	/* ----------------------------------------------------------------------
	 * CoreyHTML::getConfig()
	 *
	 * @param string $key - Config key (optional)
	 * @return mixed $config
	 * ----------------------------------------------------------------------*/
	// TODO: Add readable option for array
	public function getConfig($key = null) {
		if ($key !== null) {
			if (isset($this->config[$key])) return $this->config[$key];
			return null;
		}
		return $this->config;
	}
    
}

?>
