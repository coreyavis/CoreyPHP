<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreySessions
 * @file		CoreySessions.php
 * @version		0.1
 * @license		GNU General Public License version 3
 * @url			http://www.coreyavis.com/CoreyPHP.html
 * @author		Corey Avis <coreyavis@gmail.com>
 * @copyright	(C) 2014, 2025 Corey Avis
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, see <http://www.gnu.org/licenses>.
 * ---------------------------------------------------------------------*/

class CoreySessions {
    
    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Config Variables - Defaults
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Developer Config
	 * ----------------------------------------------------------------------*/
    private $debug = true; // NOTE: Change to false for live sites.
    
    /* ----------------------------------------------------------------------
	 * Constants / Regular Expressions - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    
    /* ----------------------------------------------------------------------
	 * CoreySessions::__construct()
	 * 
	 * @param array $config - Config options (optional)
	 * @return class $this
	 * ----------------------------------------------------------------------*/
    public function __construct($config = null) {
		
		set_error_handler(array($this, 'errorMsg'));
		set_exception_handler(array($this, 'exceptionMsg'));
		
		if ($config !== null) {
			if (!is_array($config)) $this->error('Config options must be supplied as an associative array!', 'input');
			$this->config($config);
		}
		return $this;
		
	}
    
    /* ----------------------------------------------------------------------
	 * CoreySessions::errorMsg()
	 * 
	 * @param integer $e - Level of error
	 * @param string $msg - Error message
	 * @param string $file - File causing error (optional)
	 * @param integer $line - Line number causing error (optional)
	 * @param array $context - Scope of error (optional)
	 * @return bool true
	 * ----------------------------------------------------------------------*/
	public static function errorMsg($e, $msg = '', $file = '', $line = '', $context = '') {
		
		if (error_reporting() == 0) return;
		switch($e) {
			case E_USER_ERROR:
				$title = 'PHP Error';
				$error = '<b>'.$title.'</b>: '.$msg.' in '.$file.' on line '.$line.'. ['.$e.']<br />'."\n";
			break;
			case E_USER_WARNING:
				$title = 'PHP Warning';
				$error = '<b>'.$title.'</b>: '.$msg.'. ['.$e.']<br />'."\n";
			break;
			case E_USER_NOTICE: case E_USER_DEPRECATED:
				$title = 'PHP Notice';
				$error = '<b>'.$title.'</b>: '.$msg.'. ['.$e.']<br />'."\n";
			break;
			default:
				$title = 'PHP Unknown Error';
				$error = '<b>'.$title.'</b>: '.$msg.'. ['.$e.']<br />'."\n";
			break;
		}
		$displayErrors = ini_get('display_errors');
		if (($displayErrors === 1) || (strtolower($displayErrors) === 'on')) echo $error;
		error_log($error);
		if ($e == E_USER_ERROR) exit(1);
		return true;
		
	}
	
	/* ----------------------------------------------------------------------
	 * CoreySessions::exceptionMsg()
	 * 
	 * @param object $exception
	 * @return bool true
	 * ----------------------------------------------------------------------*/
	public static function exceptionMsg($exception) {
		
		$title = 'PHP Exception';
		$error = '<b>'.$title.'</b>: '.$exception->getMessage().' in '.$exception->getFile().' on line '.$exception->getLine().'. ['.$exception->getCode().']<br /><br />'."\n";
		$error .= '<b>Stack Trace</b>:<br /><pre>'.$exception->getTraceAsString().'</pre><br />'."\n";
		echo $error;
		error_log($error);
		return true;
		
	}
	
	/* ----------------------------------------------------------------------
	 * CoreySessions::error()
	 * 
	 * @param string $msg - Error message
	 * @param mixed $type - Type of error (error, database, function, warning, input, notice, output, deprecated) (default: notice)
	 * @return bool $error
	 * ----------------------------------------------------------------------*/
	public function error($msg = '', $type = 'notice') {
		
		switch ($type) {
			case 'error': case 'database': case 'function':
				$msg = ($type != 'error'? strtoupper($type) . ' ' : '') . 'ERROR: ' . trim($msg);
				$type = E_USER_ERROR;
			break;
			case 'warning': case 'input':
				$msg = ($type != 'warning'? strtoupper($type) . ' ' : '') . ' WARNING: ' . trim($msg);
				$type = E_USER_WARNING;
			break;
			case 'notice': case 'output':
				$msg = ($type != 'notice'? strtoupper($type) . ' ' : '') . ' NOTICE: ' . trim($msg);
				$type = E_USER_NOTICE;
			break;
			case 'deprecated':
				$msg = 'NOTICE: ' . trim($msg);
				$type = E_USER_DEPRECATED;
			break;
			default:
				$msg = 'ERROR: ' . trim($msg);
				if (!is_int($type) || ($type != E_USER_ERROR) || ($type != E_USER_WARNING) || ($type != E_USER_NOTICE) || ($type != E_USER_DEPRECATED)) $type = E_USER_NOTICE;
			break;
		}
		if (($type == E_USER_DEPRECATED) && version_compare(PHP_VERSION, '5.3', '<')) $type = E_USER_NOTICE;
		if ($this->debug === true) {
			throw new Exception($msg);
			$error = true;
		} else {
			$error = trigger_error($msg, $type);
		}
		return $error;
		
	}
    
    /* ----------------------------------------------------------------------
	 * CoreySessions::config()
	 * 
	 * @param mixed $config - Config options in array or config key for key/value pair
	 * @param mixed $arg - Config value for key/value pair
	 * @return object $this
	 * ----------------------------------------------------------------------*/
	public function config($config = null, $arg = null) {
		
		if (!is_array($config) && (($config === null) || ($arg === null))) $this->error('Config function expects 2 parameters or 1 associative array!', 'input');
		if (!is_array($config)) $config = array($config => $arg);
		foreach ($config as $key => $arg) {
			if (is_numeric($key)) $this->error('Invalid config key!', 'input');
			switch ($key) {
				/*case '':
					
				break;*/
				default:
					if (in_array($key, $this->config_keys)) $this->$key = $arg;
				break;
			}
		}
		return $this;
		
	}
    
}

?>