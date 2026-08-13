<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreyPHP
 * @file		CoreyPHP.php
 * ---------------------------------------------------------------------*/
declare(strict_types=1);
enum ErrorType: string {
	case Error		= 'error';
	case Warning	= 'warning';
	case Notice		= 'notice';
	case Deprecated	= 'deprecated';
}

class CoreyPHP {
    
    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	public private(set) string $sessionId = '';
    
    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	private static bool $handlersRegistered = false;
    
    /* ----------------------------------------------------------------------
	 * Config Variables
	 * ----------------------------------------------------------------------*/
	protected array $config = [
		'cookie' => [
			'lifetime' => [
				'months' => 0,
				'weeks' => 0,
				'days' => 30,
				'hours' => 0,
				'minutes' => 0
			]
		],
		'debug' => true,
		'domain' => '',
		'dp' => 2,
		'override' => false,
		'session' => [
			'auto' => true,
			'id' => '',
			'name' => 'COREYSESSID'
		]
	];
    
    /* ----------------------------------------------------------------------
	 * Constants / Regular Expressions - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	protected const IPV4REGEX = '/^((25[0-5]|(2[0-4]|1\d|[1-9]|)\d)\.?\b){4}$/';
	protected const IPV6REGEX = '/^(?:(?:[0-9A-Fa-f]{1,4}:){6}(?:[0-9A-Fa-f]{1,4}:[0-9A-Fa-f]{1,4}|(?:(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\\.){3}(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))|::(?:[0-9A-Fa-f]{1,4}:){5}(?:[0-9A-Fa-f]{1,4}:[0-9A-Fa-f]{1,4}|(?:(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\\.){3}(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))|(?:[0-9A-Fa-f]{1,4})?::(?:[0-9A-Fa-f]{1,4}:){4}(?:[0-9A-Fa-f]{1,4}:[0-9A-Fa-f]{1,4}|(?:(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\\.){3}(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))|(?:(?:[0-9A-Fa-f]{1,4}:){0,1}[0-9A-Fa-f]{1,4})?::(?:[0-9A-Fa-f]{1,4}:){3}(?:[0-9A-Fa-f]{1,4}:[0-9A-Fa-f]{1,4}|(?:(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\\.){3}(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))|(?:(?:[0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})?::(?:[0-9A-Fa-f]{1,4}:){2}(?:[0-9A-Fa-f]{1,4}:[0-9A-Fa-f]{1,4}|(?:(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\\.){3}(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))|(?:(?:[0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})?::[0-9A-Fa-f]{1,4}:(?:[0-9A-Fa-f]{1,4}:[0-9A-Fa-f]{1,4}|(?:(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\\.){3}(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))|(?:(?:[0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})?::(?:[0-9A-Fa-f]{1,4}:[0-9A-Fa-f]{1,4}|(?:(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\\.){3}(?:[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))|(?:(?:[0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})?::[0-9A-Fa-f]{1,4}|(?:(?:[0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})?::)$/';
	protected const SERIALMATCH = '/^([adObisfNrRChSt]):/';
	
	/* ----------------------------------------------------------------------
	 * Core
	 * ----------------------------------------------------------------------*/

    /* ----------------------------------------------------------------------
	 * CoreyPHP::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		$this->setConfig($userConfig);
		if (!self::$handlersRegistered) {
			set_error_handler([$this, 'errorMsg']);
			set_exception_handler([$this, 'exceptionMsg']);
			self::$handlersRegistered = true;
		}
		$startSession = $this->getConfig('session.auto');
		if (($startSession === true) && (session_status() === PHP_SESSION_NONE)) {
			$defaultId = $this->getConfig('session.id');
			$this->sessionId = $this->startSession($defaultId);
		}
	}
	
	/* ----------------------------------------------------------------------
	 * Error Handling
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::errorMsg()
	 * 
	 * @param int $e - Error level
	 * @param string $msg - Error message
	 * @param string $file - File causing error (optional)
	 * @param string|int $line - Line number causing error (optional)
	 * @return bool|null - Returns null if error reporting is disabled, true otherwise.
	 * ----------------------------------------------------------------------*/
	public function errorMsg(int $e, string $msg = '', string $file = '', string|int $line = ''): ?bool {
		if (error_reporting() === 0) return null;
		$title = match($e) {
			E_USER_ERROR 		=> 'CoreyPHP Fatal Error',
			E_USER_WARNING 		=> 'CoreyPHP Warning',
			E_USER_DEPRECATED	=> 'CoreyPHP Deprecated',
			default 			=> 'CoreyPHP Notice'
		};
		$errorText = "<b>$title</b>: $msg in $file on line $line. [$e]<br />\n";
		error_log(strip_tags($errorText));
		if ($e === E_USER_WARNING) {
			$displayErrors = ini_get('display_errors');
			if (in_array(strtolower((string)$displayErrors), ['1', 'on', 'true'], true)) echo $errorText;
		}
		if ($e === E_USER_ERROR) exit(1);
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::exceptionMsg()
	 * 
	 * @param \Throwable $exception - The caught exception or error object.
	 * @return void - Terminates script execution vie exit(1).
	 * ----------------------------------------------------------------------*/
	public function exceptionMsg(\Throwable $exception): void {
		$debug = $this->config['debug'] ?? false;
		$title = 'CoreyPHP Exception';
		$errorHtml = <<<HTML
		<div style="border: 1px solid #990000; padding: 20px; margin: 10px; font-family: sans-serif;">
			<b style="color: #990000;">{$title}</b>: {$exception->getMessage()}<br />
			<b>File</b>: {$exception->getFile()} on line {$exception->getLine()}<br />
			<b>Code</b>: [{$exception->getCode()}]<br /><br />
			<b>Stack Trace</b>:<br />
			<pre style="background: #f4f4f4; padding: 10px;">{$exception->getTraceAsString()}</pre>
		</div>
		HTML;
		error_log($exception->getMessage() . ' in ' . $exception->getFile());
		$displayErrors = ini_get('display_errors');
		$shouldShow = in_array(strtolower((string)$displayErrors), ['1', 'on', 'true'], true) || $debug;
		if ($shouldShow) echo $errorHtml;
		exit(1);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::error()
	 * 
	 * @param string $msg - Error message
	 * @param ErrorType|string $type - The severity level (error, warning, notice, deprecated)
	 * @return bool false
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function error(string $msg = '', ErrorType|string $type = ErrorType::Notice): bool {
		if (is_string($type)) $type = ErrorType::tryFrom(strtolower($type)) ?? ErrorType::Notice;
		$debug = $this->config['debug'] ?? false;
		$finalMsg = strtoupper($type->value) . ': ' . trim($msg);
		$shouldThrow = match($type) {
			ErrorType::Error	=> true,
			ErrorType::Warning	=> ($debug === true),
			default				=> false
		};
		if ($shouldThrow) throw new \Exception($finalMsg);
		$severity = match($type) {
			ErrorType::Error		=> E_USER_ERROR,
			ErrorType::Warning		=> E_USER_WARNING,
			ErrorType::Deprecated	=> E_USER_DEPRECATED,
			default					=> E_USER_NOTICE
		};
		trigger_error($finalMsg, $severity);
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * Config Functions
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::getConfig()
	 * 
	 * @param string|null $key - Config key (optional)
	 * @return mixed - Config value or config array
	 * ----------------------------------------------------------------------*/
	public function getConfig(?string $key = null): mixed {
		if ($key === null) return $this->config;
		$parts = explode('.', $key);
		$config = $this->config;
		foreach ($parts as $part) {
			if (is_array($config) && array_key_exists($part, $config)) {
				$config = $config[$part];
			} else {
				return $this->error('Config key "' . $key . '" does not exist!', 'warning');
			}
		}
		return $config;
	}

	/* ----------------------------------------------------------------------
	 * CoreyPHP::setConfig()
	 * 
	 * @param array|string|null $key - Config options in array or config key for key/value pair
	 * @param mixed $value - Config value for key/value pair
	 * @return bool true|false - True if successful
	 * ----------------------------------------------------------------------*/
	public function setConfig(array|string|null $key = null, mixed $value = null): bool {
		if ($key === null) return $this->error('Config key is empty!', 'warning');
		if (is_array($key)) {
			$success = true;
			foreach ($key as $k => $v) {
				if (!$this->setConfig((string)$k, $v)) $success = false;
			}
			return $success;
		}
		if ($value === null) return $this->error('Config value is empty!', 'warning');
		$parts = explode('.', $key);
		$config = &$this->config;
		foreach ($parts as $i => $part) {
			if ($i === count($parts) - 1) {
				if (!is_array($config) || !array_key_exists($part, $config)) return $this->error("Config key '$key' does not exist!", 'warning');
				$config[$part] = $value;
				return true;
			}
			if (isset($config[$part]) && is_array($config[$part])) {
				$config = &$config[$part];
			} else {
				return $this->error("Config key '$key' does not exist!", 'warning');
			}
		}
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * Color Code Utility System
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::codeToColor()
	 * 
	 * @param string $colorCode - CoreyPHP color code
	 * @return string - Color name
	 * ----------------------------------------------------------------------*/
	public function codeToColor(string|int $colorCode): string {
		return match(strtolower((string) $colorCode)) {
			'a' => 'amber',
			'b' => 'blue',
			'c' => 'peach',
			'd' => 'emerald',
			'e' => 'green',
			'f' => 'forest green',
			'g' => 'gray',
			'h' => 'magenta',
			'i' => 'violet',
			'j' => 'jade',
			'k' => 'black',
			'l' => 'lime',
			'm' => 'maroon',
			'n' => 'brown',
			'o' => 'orange',
			'p' => 'pink',
			'q' => 'turquoise',
			'r' => 'red',
			's' => 'silver',
			't' => 'teal',
			'u' => 'purple',
			'v' => 'olive',
			'w' => 'white',
			'x' => 'crimson',
			'y' => 'yellow',
			'z' => 'bronze',
			'0' => 'plum',
			'1' => 'gold',
			'2' => 'navy',
			'3' => 'coral',
			'4' => 'indigo',
			'5' => 'beige',
			'6' => 'sky blue',
			'7' => 'tan',
			'8' => 'mint',
			'9' => 'lavender',
			default => 'white'
		};
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::codeToHex()
	 * 
	 * @param string|int $colorCode - CoreyPHP color code
	 * @return string - Hex color code
	 * ----------------------------------------------------------------------*/
	public function codeToHex(string|int $colorCode): string {
		$rgb = $this->codeToRgb($colorCode);
		return sprintf('#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2]);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::codeToRgb()
	 * 
	 * @param string|int $colorCode - CoreyPHP color code
	 * @return array - RGB color
	 * ----------------------------------------------------------------------*/
	public function codeToRgb(string|int $colorCode): array {
		return match(strtolower((string) $colorCode)) {
			'a' => [255, 191, 0], /* amber */
			'b' => [0, 0, 255], /* blue */
			'c' => [255, 218, 185], /* peach */
			'd' => [80, 200, 120], /* emerald */
			'e' => [0, 128, 0], /* green */
			'f' => [34, 139, 34], /* forest green */
			'g' => [128, 128, 128], /* gray */
			'h' => [202, 31, 123], /* magenta */
			'i' => [238, 130, 238], /* violet */
			'j' => [0, 168, 107], /* jade */
			'k' => [0, 0, 0], /* black */
			'l' => [0, 255, 0], /* lime */
			'm' => [128, 0, 0], /* maroon */
			'n' => [165, 42, 42], /* brown */
			'o' => [255, 128, 0], /* orange */
			'p' => [255, 192, 203], /* pink */
			'q' => [64, 224, 208], /* turquoise */
			'r' => [255, 0, 0], /* red */
			's' => [192, 192, 192], /* silver */
			't' => [0, 128, 128], /* teal */
			'u' => [128, 0, 128], /* purple */
			'v' => [128, 128, 0], /* olive */
			'w' => [255, 255, 255], /* white */
			'x' => [220, 20, 60], /* crimson */
			'y' => [255, 255, 0], /* yellow */
			'z' => [184, 115, 51], /* bronze */
			'0' => [221, 160, 221], /* plum */
			'1' => [255, 215, 0], /* gold */
			'2' => [0, 0, 128], /* navy */
			'3' => [255, 127, 80], /* coral */
			'4' => [75, 0, 130], /* indigo */
			'5' => [245, 245, 220], /* beige */
			'6' => [135, 206, 235], /* sky blue */
			'7' => [210, 180, 140], /* tan */
			'8' => [152, 251, 152], /* mint */
			'9' => [230, 230, 250], /* lavender */
			default => [255, 255, 255]
		};
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::colorToCode()
	 * 
	 * @param string $color - Color name
	 * @return string - CoreyPHP color code
	 * ----------------------------------------------------------------------*/
	public function colorToCode(string $color): string {
		return match(str_replace(' ', '', strtolower($color))) {
			'amber' => 'a',
			'beige' => '5',
			'black' => 'k',
			'blue' => 'b',
			'bronze' => 'z',
			'brown' => 'n',
			'coral' => '3',
			'crimson' => 'x',
			'emerald' => 'd',
			'forestgreen' => 'f',
			'gold' => '1',
			'gray' => 'g',
			'grey' => 'g',
			'green' => 'e',
			'indigo' => '4',
			'jade' => 'j',
			'lavender' => '9',
			'lime' => 'l',
			'magenta' => 'h',
			'maroon' => 'm',
			'mint' => '8',
			'navy' => '2',
			'olive' => 'v',
			'orange' => 'o',
			'peach' => 'c',
			'pink' => 'p',
			'plum' => '0',
			'purple' => 'u',
			'red' => 'r',
			'silver' => 's',
			'skyblue' => '6',
			'tan' => '7',
			'teal' => 't',
			'turquoise' => 'q',
			'violet' => 'i',
			'white' => 'w',
			'yellow' => 'y',
			default => 'w'
		};
	}
	
	/* ----------------------------------------------------------------------
	 * Conversion
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::arrayToJson()
	 * 
	 * @param array $array - Array to convert
	 * @return string - JSON output
	 * ----------------------------------------------------------------------*/
	public function arrayToJson(array $array = []): string {
		$json = json_encode($array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
		if (json_last_error() !== JSON_ERROR_NONE) $this->error(json_last_error_msg(), 'warning');
		return $json;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::arrayToObject()
	 * 
	 * @param array $array - Array to convert
	 * @return array|object - Object output or array with nested objects
	 * ----------------------------------------------------------------------*/
	public function arrayToObject(array $array = []): array|object {
		if ($this->isAssoc($array)) {
			return (object) array_map(function ($value) {
				return is_array($value) ? $this->arrayToObject($value) : $value;
			}, $array);
		}
		return array_map(function ($value) {
			return is_array($value) ? $this->arrayToObject($value) : $value;
		}, $array);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::arrayToSerial()
	 * 
	 * @param array $array - Array to convert
	 * @return string - Serialized output
	 * ----------------------------------------------------------------------*/
	// TODO: Make sure is doesn't attempt to change resources.
	public function arrayToSerial(array $array = []): string {
		try {
			return serialize($array);
		} catch (\Throwable $e) {
			$this->error($e->getMessage(), 'warning');
			return '';
		}
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::jsonToArray()
	 * 
	 * @param string $json - JSON to convert
	 * @return array - Array output
	 * ----------------------------------------------------------------------*/
	public function jsonToArray(string $json): array {
		try {
			$array = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
		} catch (\JsonException $e) {
			$this->error($e->getMessage(), 'warning');
			return [];
		}
		return is_array($array)? $array : [];
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::jsonToObject()
	 * 
	 * @param string $json - JSON to convert
	 * @return array|object - Object output or array with nested object
	 * ----------------------------------------------------------------------*/
	public function jsonToObject(string $json): array|object {
		return $this->arrayToObject($this->jsonToArray($json));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::jsonToSerial()
	 * 
	 * @param string $json - JSON to convert
	 * @return string - Serialized output
	 * ----------------------------------------------------------------------*/
	public function jsonToSerial(string $json): string {
		return $this->arrayToSerial($this->jsonToArray($json));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::objectToArray()
	 * 
	 * @param array|object $object - Object or array with nested objects to convert
	 * @return array - Array output
	 * ----------------------------------------------------------------------*/
	public function objectToArray(array|object $object): array {
		if (is_object($object)) $object = get_object_vars($object);
		return array_map(function ($value) {
			if (is_object($value) || is_array($value)) return $this->objectToArray($value);
			return $value;
		}, $object);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::objectToJson()
	 * 
	 * @param array|object $object - Object or array with nested objects to convert
	 * @return string - JSON output
	 * ----------------------------------------------------------------------*/
	public function objectToJson(array|object $object): string {
		return $this->arrayToJson($this->objectToArray($object));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::objectToSerial()
	 * 
	 * @param array|object $object - Object or array with nested objects to convert
	 * @return string - Serialized output
	 * ----------------------------------------------------------------------*/
	public function objectToSerial(array|object $object): string {
		return $this->arrayToSerial($this->objectToArray($object));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::serialToArray()
	 * 
	 * @param string $serial - Serial string to convert
	 * @return array - Array output
	 * ----------------------------------------------------------------------*/
	public function serialToArray(string $serial): array {
		set_error_handler(static function ($severity, $message, $file, $line) {
			throw new \ErrorException($message, 0, $severity, $file, $line);
		});
		try {
			$array = unserialize($serial, ['allowed_classes' => false]);
		} catch (\Throwable $e) {
			$this->error($e->getMessage(), 'warning');
			return [];
		} finally {
			restore_error_handler();
		}
		return is_array($array)? $array : [];
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::serialToJson()
	 * 
	 * @param string $serial - Serial string to convert
	 * @return string - JSON output
	 * ----------------------------------------------------------------------*/
	public function serialToJson(string $serial): string {
		return $this->arrayToJson($this->serialToArray($serial));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::serialToObject()
	 * 
	 * @param string $serial - Serial string to convert
	 * @return array|object - Object output or array with nested objects
	 * ----------------------------------------------------------------------*/
	public function serialToObject(string $serial): array|object {
		return $this->arrayToObject($this->serialToArray($serial));
	}
	
	/* ----------------------------------------------------------------------
	 * Cookies
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::getCookie()
	 * 
	 * @param ?string $key - Cookie name/key or null
	 * @return mixed - Cookie value or all cookies
	 * ----------------------------------------------------------------------*/
	public function getCookie(?string $key = null): mixed {
		if ($key === null) {
			$cookies = [];
			foreach ($_COOKIE as $k => $v) {
				$cookies[$k] = $this->isJson($v)? $this->jsonToArray($v) : $v;
			}
			return $this->sanitizeData($cookies);
		}
		if (isset($_COOKIE[$key])) {
			$value = $_COOKIE[$key];
			if ($this->isJson($value)) {
				$value = $this->jsonToArray($value);
			}
			return $this->sanitizeData($value);
		}
		return null;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::removeCookie()
	 * 
	 * @param string $key - Cookie name/key to remove
	 * @return bool - Successfully removed cookie
	 * ----------------------------------------------------------------------*/
	public function removeCookie(string $key): bool {
		if (!isset($_COOKIE[$key])) {
			$this->error('The cookie "' . $key . '" does not exist!', 'notice');
			return false;
		}
		unset($_COOKIE[$key]);
		return setcookie($key, "", [
			'expires' => (time() - 42000),
			'path' => '/',
			'domain' => $this->resolveDomain(),
			'secure' => $this->isHttps(),
			'httponly' => true,
			'samesite' => 'Lax'
		]);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::setCookie()
	 * 
	 * @param string $key - Cookie name/key to create
	 * @param mixed $value - Cookie value
	 * @return bool - Successfully created cookie
	 * ----------------------------------------------------------------------*/
	public function setCookie(string $key, mixed $value): bool {
		$key = $this->sanitizeValue($key);
		$value = $this->sanitizeData($value);
		if (is_array($value)) $value = $this->arrayToJson($value);
		$months = (int) ($this->getConfig('cookie.lifetime.months') ?? 0);
		$weeks = (int) ($this->getConfig('cookie.lifetime.weeks') ?? 0);
		$days = (int) ($this->getConfig('cookie.lifetime.days') ?? 0);
		$hours = (int) ($this->getConfig('cookie.lifetime.hours') ?? 0);
		$minutes = (int) ($this->getConfig('cookie.lifetime.minutes') ?? 0);
		$seconds = ($months * 30 * 86400) + ($weeks * 7 * 86400) + ($days * 86400) + ($hours * 3600) + ($minutes * 60);
		if ($seconds <= 0) $seconds = 86400;
		$seconds = max(60, min(31536000, $seconds));
		$lifetime = time() + $seconds;
		return setcookie($key, $value, [
			'expires' => $lifetime,
			'path' => '/',
			'domain' => $this->resolveDomain(),
			'secure' => $this->isHttps(),
			'httponly' => true,
			'samesite' => 'Lax'
		]);
	}
	
	/* ----------------------------------------------------------------------
	 * Formatting
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::decimals()
	 * 
	 * @param int|float $arg - Number to round or format
	 * @param int $dp - Decimal points (defaults to config)
	 * @param bool $asString - Return as string with trailing zeros
	 * @return string|float $seconds - Formatted string or rounded float
	 * ----------------------------------------------------------------------*/
	public function decimals(int|float $arg = 0, int $dp = -1, bool $asString = false): string|float {
		$dp = ($dp >= 0? $dp : $this->getConfig('dp'));
		if ($asString === true) {
			return number_format((float) $arg, $dp, '.', '');
		} else {
			return round((float) $arg, $dp);
		}
	}
	
	/* ----------------------------------------------------------------------
	 * IP Operations
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::getIP()
	 * 
	 * @param bool $long - Return long
	 * @return mixed $ip - IP address
	 * ----------------------------------------------------------------------*/
	public function getIP(bool $long = false): mixed {
		$ip = null;
		$headers = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'REMOTE_ADDR'];
		foreach ($headers as $header) {
			$value = $_SERVER[$header] ?? getenv($header);
			if (!empty($value)) {
				foreach (explode(',', $value) as $currentIP) {
					$currentIP = trim($currentIP);
					if ($this->validIP($currentIP)) {
						if (($long === true) && preg_match(self::IPV4REGEX, $currentIP)) return ip2long($currentIP);
						return $currentIP;
					}
				}
			}
		}
		return $ip;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::reservedIP()
	 * 
	 * @param string $ip - IP address
	 * @return bool true|false - True if reserved IP address
	 * ----------------------------------------------------------------------*/
	public function reservedIP(?string $ip = null): bool {
		if ($ip === null) {
			$this->error('IP address must not be empty!');
			return false;
		}
		if (!$this->validIP($ip)) return false;
		if (preg_match(self::IPV4REGEX, $ip)) {
			$reserved_ipv4 = array(
				array('0.0.0.0', '0.255.255.255'),
				array('10.0.0.0', '10.255.255.255'),
				array('100.64.0.0', '100.127.255.255'),
				array('127.0.0.0', '127.255.255.255'),
				array('169.254.0.0', '169.254.255.255'),
				array('172.16.0.0', '172.31.255.255'),
				array('192.0.0.0', '192.0.0.255'),
				array('192.0.2.0', '192.0.2.255'),
				array('192.88.99.0', '192.88.99.255'),
				array('192.168.0.0', '192.168.255.255'),
				array('198.18.0.0', '198.19.255.255'),
				array('198.51.100.0', '198.51.100.255'),
				array('203.0.113.0', '203.0.113.255'),
				array('224.0.0.0', '239.255.255.255'),
				array('240.0.0.0', '255.255.255.254'),
				array('255.255.255.0', '255.255.255.255')
			);
			foreach ($reserved_ipv4 as $ipv4) {
				$min = ip2long($ipv4[0]);
				$max = ip2long($ipv4[1]);
				if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return true;
			}
		} else {
			$ipBinary = inet_pton($ip);
			$reserved_ipv6 = array(
				array('::', '::'),
        		array('::1', '::1'),
        		array('::ffff:0:0', '::ffff:ffff:ffff'),
				array('::ffff:c0a8:0', '::ffff:c0a8:ffff:ffff'),
        		array('100::', '100::ffff:ffff:ffff:ffff'),
        		array('2001:db8::', '2001:db8:ffff:ffff:ffff:ffff:ffff:ffff'),
        		array('fc00::', 'fdff:ffff:ffff:ffff:ffff:ffff:ffff:ffff'),
        		array('fe80::', 'febf:ffff:ffff:ffff:ffff:ffff:ffff:ffff'),
        		array('ff00::', 'ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff')
			);
			foreach ($reserved_ipv6 as $ipv6) {
				$start = inet_pton($ipv6[0]);
				$end = inet_pton($ipv6[1]);
				if (strlen($ipBinary) === strlen($start)) {
					if (($ipBinary >= $start) && ($ipBinary <= $end)) return true;
				}
			}
		}
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::validIP()
	 * 
	 * @param string $ip - IP address
	 * @param string &$version - IPv4 or IPv6 (passed by reference)
	 * @return bool true|false - True if valid IP address
	 * ----------------------------------------------------------------------*/
	public function validIP(?string $ip = null, ?string &$version = null): bool {
		if ($ip === null) {
			$this->error('IP address must not be empty!');
			return false;
		}
		if (preg_match(self::IPV4REGEX, $ip)) {
			if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
				$version = 'IPv4';
				return true;
			}
		} else if (preg_match(self::IPV6REGEX, $ip)) {
			if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
				$version = 'IPv6';
				return true;
			}
		} else if (filter_var($ip, FILTER_VALIDATE_IP)) {
			return true;
		}
		$this->error('Invalid IP address format!');
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * Sessions
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::clearSession()
	 * 
	 * @return bool - All session data cleared
	 * ----------------------------------------------------------------------*/
	public function clearSession(): bool {
		$_SESSION = [];
		if (session_status() === PHP_SESSION_ACTIVE) session_unset();
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::endSession()
	 * 
	 * @return bool - Session destroyed
	 * ----------------------------------------------------------------------*/
	public function endSession(): bool {
		$_SESSION = [];
		if (ini_get('session.use_cookies')) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', [
				'expires' => time() - 42000,
				'path' => $params['path'],
				'domain' => $params['domain'],
				'secure' => $params['secure'],
				'httponly' => $params['httponly'],
				'samesite' => $params['samesite'] ?? 'Lax'
			]);
		}
		if (session_status() === PHP_SESSION_ACTIVE) session_destroy();
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::getSession()
	 * 
	 * @param ?string $key - Session key or null
	 * @return mixed - Session value or all session data
	 * ----------------------------------------------------------------------*/
	public function getSession(?string $key = null): mixed {
		if ($key === null) return $_SESSION ?? [];
		return isset($_SESSION[$key])? $_SESSION[$key] : null;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::regenSession()
	 * 
	 * @param bool $deleteOldSession - Delete old associative session
	 * @return bool - Regeneration successful
	 * ----------------------------------------------------------------------*/
	public function regenSession(bool $deleteOldSession = true): bool {
		if (session_status() === PHP_SESSION_ACTIVE) return session_regenerate_id($deleteOldSession);
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::removeSession()
	 * 
	 * @param string $key - Session key to remove
	 * @return bool - Removal successful
	 * ----------------------------------------------------------------------*/
	public function removeSession(string $key): bool {
		if (!isset($_SESSION[$key])) {
			$this->error('The session variable "' . $key . '" does not exist!', 'notice');
			return false;
		}
		unset($_SESSION[$key]);
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::setSession()
	 * 
	 * @param string $key - Session key
	 * @param mixed $value - Session value to store
	 * @return bool - true
	 * ----------------------------------------------------------------------*/
	public function setSession(string $key, mixed $value): bool {
		$key = $this->sanitizeValue($key);
		$value = $this->sanitizeData($value);
		$_SESSION[$key] = $value;
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::startSession()
	 * 
	 * @param string $id - Custom Session ID
	 * @return string - Generated or returned Session ID
	 * ----------------------------------------------------------------------*/
	public function startSession(string $id): string {
		if (session_status() === PHP_SESSION_ACTIVE) return session_id();
		session_set_cookie_params([
			'lifetime' => 0,
			'path' => '/',
			'domain' => $this->resolveDomain(),
			'secure' => $this->isHttps(),
			'httponly' => true,
			'samesite' => 'Lax'
		]);
		session_name($this->getConfig('session.name'));
		if (!empty($id)) session_id($id);
		session_start();
		return session_id();
	}
	
	/* ----------------------------------------------------------------------
	 * Validation
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::isAssoc()
	 * 
	 * @param array $array - Array to validate
	 * @param bool $strict - Checks every key
	 * @return bool
	 * ----------------------------------------------------------------------*/
	public function isAssoc(array $array = [], bool $strict = false): bool {
		if (empty($array) || !is_array($array)) return false;
		if ($strict === true) {
			foreach ($array as $key => $value) {
				if (!is_string($key)) return false;
			}
			return true;
		}
		foreach ($array as $key => $value) {
			if (is_string($key)) return true;
		}
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::isJson()
	 * 
	 * @param string $string - JSON string to validate
	 * @return bool - Valid JSON
	 * ----------------------------------------------------------------------*/
	public function isJson(mixed $string): bool {
		if (!is_string($string)) return false;
		$string = trim($string);
		if (!str_starts_with($string, '{') && !str_starts_with($string, '[')) return false;
		
		if (function_exists('json_validate')) {
			return json_validate($string);
		}
		json_decode($string);
		return (json_last_error() === JSON_ERROR_NONE);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::isSerial()
	 * 
	 * @param mixed $data - Data to validate
	 * @return bool
	 * ----------------------------------------------------------------------*/
	public function isSerial(mixed $data = null): bool {
		if ($data === null) return $this->error('No data present in isSerial() method!');
		if (!is_string($data) || (trim($data) === '')) return false;
		if (!preg_match(self::SERIALMATCH, $data)) return false;
		return @unserialize($data, ['allowed_classes' => false]) !== false || ($data === 'b:0;');
	}
	
	/* ----------------------------------------------------------------------
	 * Helpers
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::autoDetectDomain()
	 * 
	 * @return string - Domain address detected
	 * ----------------------------------------------------------------------*/
	protected function autoDetectDomain(): string {
		$host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';
		$host = strtolower(explode(':', $host)[0]);
		if (empty($host) || ($host === 'localhost') || filter_var($host, FILTER_VALIDATE_IP)) return '';
		if (str_starts_with($host, 'www.')) $host = substr($host, 4);
		return '.' . ltrim($host, '.');
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::escape()
	 * 
	 * @param mixed $value - Value to escape
	 * @return string - Escaped value
	 * ----------------------------------------------------------------------*/
	// NOTE: Not currently in use.
	protected function escape(mixed $value): string {
		return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::isHttps()
	 * 
	 * @return bool - Secure connection detected
	 * ----------------------------------------------------------------------*/
	protected function isHttps(): bool {
		if (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) !== 'off')) return true;
		if (isset($_SERVER['SERVER_PORT']) && ((int) $_SERVER['SERVER_PORT'] === 443)) return true;
		if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && (strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')) return true;
		if (isset($_SERVER['HTTP_FRONT_END_HTTPS']) && (strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')) return true;
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::resolveDomain()
	 * 
	 * @return string - Resolved domain address
	 * ----------------------------------------------------------------------*/
	protected function resolveDomain(): string {
		$domain = trim((string) $this->getConfig('domain'));
		if (!empty($domain)) {
			if (str_starts_with(strtolower($domain), 'www.')) {
				return '.' . ltrim(substr($domain, 4), '.');
			}
			return $domain;
		}
		return $this->autoDetectDomain();
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::sanitizeData()
	 * 
	 * @param mixed $data - Data to sanitize
	 * @return mixed - Sanitized data
	 * ----------------------------------------------------------------------*/
	protected function sanitizeData(mixed $data): mixed {
		if (is_array($data)) {
			$clean = [];
			foreach ($data as $key => $value) {
				$cleanKey = $this->sanitizeValue($key);
				$clean[$cleanKey] = $this->sanitizeData($value);
			}
			return $clean;
		}
		if (is_object($data)) {
			$cleanObj = clone $data;
			foreach ($data as $key => $value) {
				$cleanKey = $this->sanitizeValue($key);
				$cleanValue = $this->sanitizeData($value);
				if ($cleanKey !== $key) unset($cleanObj->$key);
				$cleanObj->$cleanKey = $cleanValue;
			}
			return $cleanObj;
		}
		return $this->sanitizeValue($data);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::sanitizeValue()
	 * 
	 * @param mixed $value - Value to sanitize
	 * @return mixed - Sanitized value
	 * ----------------------------------------------------------------------*/
	protected function sanitizeValue(mixed $value): mixed {
		if (is_string($value)) {
			return trim(str_replace("\0", '', $value));
		}
		return $value;
	}
    
}

?>
