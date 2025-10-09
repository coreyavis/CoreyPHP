<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreyFX
 * @file		CoreyFX.php
 * ---------------------------------------------------------------------*/

class CoreyFX {
    
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
        'dp' => 2
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
	 * CoreyFX::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * @return NULL
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		$this->setConfig($userConfig);
	}

	/* ----------------------------------------------------------------------
	 * CoreyFX::setConfig()
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
	 * CoreyFX::getConfig()
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
	
	/* ----------------------------------------------------------------------
	 * Array Functions
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::extendArray()
	 * 
	 * @param array $extend - Array to extend
	 * @param array $arrays - Variable list of arrays to add
	 * @return array $extend - Extended array
	 * ----------------------------------------------------------------------*/
	public function extendArray($extend = null, $arrays = null) {
		//if (($extend !== null) && !is_array($extend)) $this->error('Function only extends arrays!', 'input');
		if (($extend !== null) && ($arrays !== null)) {
			$arrays = func_get_args();
			array_walk($arrays, function($array) {
				//if (!is_array($array)) $this->error('Invalid array defined!', 'input');
				foreach ($array as $key => $value) {
					if (is_int($key)) {
						$this->temp_array[] = $value;
						unset($array[$key]);
					} elseif (is_array($value)) {
						foreach ($value as $skey => $svalue) {
							if (is_int($skey)) {
								$this->temp_array[$key][] = $svalue;
								unset($array[$key][$skey]);
							}
						}
					}
				}
			});
			$extend = array_shift($arrays);
			//if ($extend === null) $this->error('Invalid array!', 'input');
			if (version_compare(PHP_VERSION, '5.3', '>=')) {
				$extend = array_replace_recursive($extend, ...$arrays);
			} else {
				$extend = array_merge_recursive($extend, ...$arrays);
			}
			if ($this->temp_array !== null) {
				if (version_compare(PHP_VERSION, '5.3', '>=')) {
					$extend = array_replace_recursive($extend, $this->temp_array);
				} else {
					$extend = array_merge_recursive($extend, $this->temp_array);
				}
				$this->temp_array = null;
				foreach ($extend as $key => $value) {
					if (is_int($key) && is_array($value)) {
						$this->temp_array[] = $value;
						unset($extend[$key]);
					}
				};
				if ($this->temp_array !== null) {
					$extend[] = array_merge_recursive(...$this->temp_array);
					$this->temp_array = null;
				}
			}
		}
		return array_splice($extend, 0);
	}
    
}

?>
