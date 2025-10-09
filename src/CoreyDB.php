<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreyDB
 * @file		CoreyDB.php
 * ---------------------------------------------------------------------*/

class CoreyDB {
    
    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Config Variables
	 * ----------------------------------------------------------------------*/
	private array $defaults = [
        'host' => 'localhost',
		'name' => '',
		'user' => 'root',
		'pass' => 'root',
		'blacklist' => ['information_schema', 'performance_schema', 'mysql', 'phpmyadmin']
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
	 * CoreyDB::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * @return NULL
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		$this->setConfig($userConfig);
	}

	/* ----------------------------------------------------------------------
	 * CoreyDB::setConfig()
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
	 * CoreyDB::getConfig()
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
