<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreyFX
 * @file		CoreyFX.php
 * ---------------------------------------------------------------------*/
declare(strict_types=1);

class CoreyFX extends CoreyPHP {
    
    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	private float $time = 0.0;
	private array $countrycodes = ['1', '7', '20', '27', '30', '31', '32', '33', '34', '36', '39', '40', '41', '43', '44', '45', '46', '47', '48', '49', '51', '52', '53', '54', '55', '56', '57', '58', '60', '61', '62', '63', '64', '65', '66', '81', '82', '84', '86', '90', '91', '92', '93', '94', '95', '98', '212', '213', '216', '218', '220', '221', '222', '223', '224', '225', '226', '227', '228', '229', '230', '231', '232', '233', '234', '235', '236', '237', '238', '239', '240', '241', '242', '243', '244', '245', '246', '247', '248', '249', '250', '251', '252', '253', '254', '255', '256', '257', '258', '260', '261', '262', '263', '264', '265', '266', '267', '268', '269', '290', '291', '297', '298', '299', '350', '351', '352', '353', '354', '355', '356', '357', '358', '359', '370', '371', '372', '373', '374', '375', '376', '377', '378', '379', '380', '381', '382', '383', '385', '386', '387', '389', '420', '421', '423', '500', '501', '502', '503', '504', '505', '506', '507', '508', '509', '590', '591', '592', '593', '594', '595', '596', '597', '598', '599', '670', '672', '673', '674', '675', '676', '677', '678', '679', '680', '681', '682', '683', '685', '686', '687', '688', '689', '690', '691', '692', '850', '852', '853', '855', '856', '880', '886', '960', '961', '962', '963', '964', '965', '966', '967', '968', '970', '971', '972', '973', '974', '975', '976', '977', '992', '993', '994', '995', '996', '998'];
	
    /* ----------------------------------------------------------------------
	 * Constants / Regular Expressions - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	protected const DATEFORMAT = 'F d, Y';
	protected const DATEFORMATABBR = 'M d, Y';
	protected const DATETIMEFORMAT = 'F d, Y g:i A';
	protected const DATETIMEFORMATABBR = 'M d, Y g:i A';
	protected const DAYREGEX = '/^(0?[1-9]|[12]\d|3[01])$/';
	protected const DECIMALREGEX = '/^(\-?)([0-9]*)(\.([0-9]+))$/';
	protected const DOUBLEDOTS = '/\.{2,}/';
	protected const EMAILREGEX = '/^((?:[A-Za-z]{1})|(?:[A-Za-z0-9]{1}[\w\.\-!#\$%&\'\*\+\/=\?\^`\{\}\|~]+[^\.])|(?:"[\w\s\.\-!#\$%&\'\*\+\/=\?\^`\{\}\|~\(\),:;<>@\[\]]*"))@(((?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\])))$/is';
	protected const EMAILTS = 'r';
	protected const FRACTIONREGEX = '/^(\-?\d*\.?\d+)\/(\-?\d*\.?\d+)$/';
	protected const HOURREGEX = '/^([01]?\d|2[0-3])$/';
	protected const INTLPHONEREGEX = '/^\+([0-9\s\-\.\(\)]{6,22})(?:[\s]?(?:x|ext[\.]?)[\s]?(\d+))?$/i';
	protected const MINSECREGEX = '/^[0-5]?\d$/';
	protected const MONTHREGEX = '/^(0?[1-9]|1[0-2])$/';
	protected const PHONEREGEX = '/^(?:[+]?(1))?[\s|\-|\.]?[\(]?(\d{3})[\)]?[\s]?[\-|\.]?(\d{3})[\s]?[\-|\.]?(\d{4})[\s]?(?:(?:x|ext[\.]?)[\s]?(\d*))?$/';
	protected const SQLDATE = 'Y-m-d';
	protected const SQLTIME = 'H:i:s';
	protected const SQLTIMESTAMP = 'Y-m-d H:i:s';
	protected const SQLTSREGEX = '/^(\d{4})-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]) ([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/';
	protected const TIMECODEREGEX = '/^(-?)(?:([0-9]*):)?([0-9]*):(([0-9]*)(?:\.([0-9]+))?)$/';
	protected const TIMEFORMAT = 'g:i A';
	protected const YEARREGEX = '/^\d{4}$/';
	
	/* ----------------------------------------------------------------------
	 * Core
	 * ----------------------------------------------------------------------*/

    /* ----------------------------------------------------------------------
	 * CoreyFX::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		$defaults = [
			'abbr' => false,
			'debug' => false,
			'dp' => 2,
			'override' => false
		];
		$this->config = array_merge($defaults, $this->config);
		parent::__construct($userConfig);
	}
	
	/* ----------------------------------------------------------------------
	 * Array Management
	 * ----------------------------------------------------------------------*/
	
	// TODO: extendArray
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::flipArray()
	 * 
	 * Flips an array with conditional logic.
	 * @param array $array - Array to flip
	 * @return array $array - Flipped array
	 * ----------------------------------------------------------------------*/
	public function flipArray(array $array = []): array {
		if (empty($array)) $this->error('The array to flip is empty!', 'warning');
		$flipped = [];
		foreach ($array as $key => $arg) {
			if (is_array($arg)) {
				if (array_is_list($arg)) {
					foreach ($arg as $value) {
						$flipped[$value] = $key;
					}
				} else {
					$flipped[$key] = $this->flipArray($arg);
				}
			} else {
				if (array_key_exists($arg, $flipped)) {
					if (is_array($flipped[$arg])) {
						array_push($flipped[$arg], $key);
					} else {
						$temp = $flipped[$arg];
						$flipped[$arg] = array($temp);
						array_push($flipped[$arg], $key);
					}
				} else {
					$flipped[$arg] = $key;
				}
			}
		}
		return $flipped;
	}
	
	/* ----------------------------------------------------------------------
	 * Date and Time Processing
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::emailTimestamp()
	 * 
	 * @param string|int|null $date - Date (optional)
	 * @return string - Email Timestamp
	 * ----------------------------------------------------------------------*/
	public function emailTimestamp(string|int|null $date = null): string {
		if ($date !== null) {
			if (is_numeric($date)) return date(self::EMAILTS, $date);
			return date(self::EMAILTS, $this->timestamp($date));
		}
		return date(self::EMAILTS, $this->timestamp());
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::formatDuration()
	 * 
	 * @param string|int $start - Start Date/Time
	 * @param string|int $end - End Date/Time
	 * @return string - Elapsed duration
	 * ----------------------------------------------------------------------*/
	public function formatDuration(string|int $start = 0, string|int $end = 0): string {
		$abbr = $this->getConfig('abbr');
		$zeroString = ($abbr === true)? '0 secs' : '0 seconds';
		if (empty($start) && empty($end)) return $zeroString;
		if (empty($start)) {
			$this->error('A start date is required!', 'warning');
			return $zeroString;
		}
		try {
			$startStr = is_numeric($start)? '@' . $start : (string) $start;
			$startDate = new DateTimeImmutable($startStr);
			$endValue = (!empty($end)? $this->sqlTimestamp($end) : $this->sqlTimestamp());
			$endStr = is_numeric($endValue)? '@' . $endValue : (string) $endValue;
			$endDate = new DateTimeImmutable($endStr);
		} catch (\Throwable $e) {
			$this->error('Invalid date format provided: ' . $e-getMessage(), 'warning');
			return $zeroString;
		}
		$interval = $startDate->diff($endDate);
		$units = ($abbr === true)? ['y' => 'yr', 'm' => 'mo', 'd' => 'day', 'h' => 'hr', 'i' => 'min', 's' => 'sec'] : ['y' => 'year', 'm' => 'month', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second'];
		$parts = [];
		foreach ($units as $prop => $label) {
			if ($interval->$prop > 0) {
				$parts[] = $interval->$prop . ' ' . $label . ($interval->$prop > 1? 's' : '');
			}
		}
		return $parts? implode(' ', $parts) : $zeroString;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::makeTimestamp()
	 * 
	 * @param int $year - Year (optional)
	 * @param int $month - Month (optional)
	 * @param int $day - Day (optional)
	 * @param int $hour - Hour (optional)
	 * @param int $minute - Minute (optional)
	 * @param int $second - Second (optional)
	 * @return int - Timestamp
	 * ----------------------------------------------------------------------*/
	public function makeTimestamp(int $year = 0, int $month = 0, int $day = 0, int $hour = 0, int $minute = 0, int $second = 0): int {
		$year = (preg_match(self::YEARREGEX, "$year"))? $year : date('Y');
		$month = (preg_match(self::MONTHREGEX, "$month"))? $month : date('m');
		$day = (preg_match(self::DAYREGEX, "$day"))? $day : date('d');
		$hour = (preg_match(self::HOURREGEX, "$hour"))? $hour : date('H');
		$minute = (preg_match(self::MINSECREGEX, "$minute"))? $minute : date('i');
		$second = (preg_match(self::MINSECREGEX, "$second"))? $second : date('s');
		$ts = "{$year}-{$month}-{$day} {$hour}:{$minute}:{$second}";
		return $this->timestamp($ts);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::showDate()
	 * 
	 * @param string|int|null $timestamp - Timestamp
	 * @param bool $abbr - Month abbreviation
	 * @return string - Date
	 * ----------------------------------------------------------------------*/
	public function showDate(string|int|null $timestamp = null, bool $abbr = false): string {
		$format = ($abbr === true? self::DATEFORMATABBR : self::DATEFORMAT);
		if ($timestamp !== null) {
			if (is_numeric($timestamp)) return date($format, $timestamp);
			return date($format, $this->timestamp($timestamp));
		}
		return date($format, $this->timestamp());
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::showDatetime()
	 * 
	 * @param string|int|null $timestamp - Timestamp
	 * @param bool $abbr - Month abbreviation
	 * @return string - Date and Time
	 * ----------------------------------------------------------------------*/
	public function showDatetime(string|int|null $timestamp = null, bool $abbr = false): string {
		$format = ($abbr === true? self::DATETIMEFORMATABBR : self::DATETIMEFORMAT);
		if ($timestamp !== null) {
			if (is_numeric($timestamp)) return date($format, $timestamp);
			return date($format, $this->timestamp($timestamp));
		}
		return date($format, $this->timestamp());
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::showTime()
	 * 
	 * @param string|int|null $timestamp - Timestamp
	 * @return string - Time
	 * ----------------------------------------------------------------------*/
	public function showTime(string|int|null $timestamp = null): string {
		$format = self::TIMEFORMAT;
		if ($timestamp !== null) {
			if (is_numeric($timestamp)) return date($format, $timestamp);
			return date($format, $this->timestamp($timestamp));
		}
		return date($format, $this->timestamp());
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::sqlDate()
	 * 
	 * @param string|int|null $datetime - Date/time (optional)
	 * @return string - SQL Date
	 * ----------------------------------------------------------------------*/
	public function sqlDate(string|int|null $datetime = null): string {
		if ($datetime !== null) {
			if (is_numeric($datetime)) return date(self::SQLDATE, $datetime);
			return date(self::SQLDATE, $this->timestamp($datetime));
		}
		return date(self::SQLDATE, $this->timestamp());
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::sqlTime()
	 * 
	 * @param string|int|null $datetime - Date/time (optional)
	 * @return string - SQL Date
	 * ----------------------------------------------------------------------*/
	public function sqlTime(string|int|null $datetime = null): string {
		if ($datetime !== null) {
			if (is_numeric($datetime)) return date(self::SQLTIME, $datetime);
			return date(self::SQLTIME, $this->timestamp($datetime));
		}
		return date(self::SQLTIME, $this->timestamp());
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::sqlTimestamp()
	 * 
	 * @param string|int|null $datetime - Date/time (optional)
	 * @return string - SQL Timestamp
	 * ----------------------------------------------------------------------*/
	public function sqlTimestamp(string|int|null $datetime = null): string {
		if ($datetime !== null) {
			if (is_numeric($datetime)) return date(self::SQLTIMESTAMP, $datetime);
			return date(self::SQLTIMESTAMP, $this->timestamp($datetime));
		}
		return date(self::SQLTIMESTAMP, $this->timestamp());
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::timecode()
	 * 
	 * @param mixed $seconds - Seconds
	 * @param int $minutes - Minutes
	 * @param int $hours - Hours
	 * @param int $ms - Milliseconds
	 * @return string - Time formatted to a timecode
	 * ----------------------------------------------------------------------*/
	public function timecode(mixed $seconds = 0, int $minutes = 0, int $hours = 0, int $ms = 0): string {
		if (!is_numeric($hours) || !is_numeric($minutes) || !is_numeric($seconds) || !is_numeric($ms)) $this->error('Invalid argument(s)!', 'warning');
		$neg = false;
		if ($ms != 0) {
			$pad = ($ms < 0? 4 : 3);
			$ms = (int) str_pad(strval($ms), $pad, '0', STR_PAD_RIGHT);
		}
		if (preg_match(self::DECIMALREGEX, strval($seconds), $match)) {
			$seconds = (int) $match[2];
			if (isset($match[1]) && ($match[1] == '-')) $seconds *= -1;
			if (isset($match[4]) && ($match[4] != '')) $ms += (int) str_pad($match[4], 3, '0', STR_PAD_RIGHT);
		}
		if ($ms != 0) {
			$ms += ($seconds * 1000) + ($minutes * 60 * 1000) + ($hours * 60 * 60 * 1000);
			$seconds = 0;
			$minutes = 0;
			$hours = 0;
			if ($ms < 0) {
				$neg = true;
				$ms *= -1;
			}
			if ($ms >= 1000) {
				$seconds += (int) floor($ms / 1000);
				$ms %= 1000;
			}
		}
		$seconds += ($minutes * 60) + ($hours * 60 * 60);
		$minutes = 0;
		$hours = 0;
		if ($seconds < 0) {
			$neg = true;
			$seconds *= -1;
		}
		if ($seconds >= 60) {
			$minutes += intdiv($seconds, 60);
			$seconds = $seconds % 60;
		}
		if ($minutes >= 60) {
			$hours += intdiv($minutes, 60);
			$minutes = $minutes % 60;
		}
		return ($neg === true? '-' : '') . str_pad(strval($hours), 2, '0', STR_PAD_LEFT) . ':' . str_pad(strval($minutes), 2, '0', STR_PAD_LEFT) . ':' . str_pad(strval($seconds), 2, '0', STR_PAD_LEFT) . ($ms != 0? '.' . $ms : '');
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::timecodeConvert()
	 * 
	 * @param string $timecode - Timecode to convert
	 * @return mixed - Seconds
	 * ----------------------------------------------------------------------*/
	public function timecodeConvert(string $timecode = '00:00:00'): mixed {
		$neg = false;
		$seconds = 0;
		$minutes = 0;
		$hours = 0;
		$ms = 0;
		if ($this->isTimecode($timecode, $match)) {
			$neg = (bool) $match['negative'];
			$hours = (int) $match['hours'];
			$minutes = (int) $match['minutes'];
			$seconds = (int) $match['seconds'];
			$ms = (int) $match['ms'];
		} else {
			$this->error('Invalid timecode!', 'warning');
			return false;
		}
		$seconds += ($minutes * 60) + ($hours * 60 * 60);
		if ($neg === true) $seconds *= -1;
		if ($ms != 0) $seconds = $seconds . '.' . $ms;
		$seconds = $this->timeConvert($seconds);
		return $seconds;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::timeConvert()
	 * 
	 * @param mixed $seconds - Seconds
	 * @param int $minutes - Minutes
	 * @param int $hours - Hours
	 * @param int $ms - Milliseconds
	 * @return mixed $seconds - Time formatted to seconds
	 * ----------------------------------------------------------------------*/
	public function timeConvert(mixed $seconds = 0, int $minutes = 0, int $hours = 0, int $ms = 0): mixed {
		if (!is_numeric($hours) || !is_numeric($minutes) || !is_numeric($seconds) || !is_numeric($ms)) $this->error('Invalid argument(s)!', 'warning');
		$neg = false;
		if ($ms != 0) {
			$pad = ($ms < 0? 4 : 3);
			$ms = (int) str_pad(strval($ms), $pad, '0', STR_PAD_RIGHT);
		}
		if (preg_match(self::DECIMALREGEX, strval($seconds), $match)) {
			$seconds = (int) $match[2];
			if (isset($match[1]) && ($match[1] == '-')) $seconds = $seconds * -1;
			if (isset($match[4]) && ($match[4] != '')) $ms += (int) str_pad($match[4], 3, '0', STR_PAD_RIGHT);
		}
		if ($ms != 0) {
			$ms += ($seconds * 1000) + ($minutes * 60 * 1000) + ($hours * 60 * 60 * 1000);
			$seconds = 0;
			if ($ms < 0) {
				$neg = true;
				$ms *= -1;
			}
			$seconds += floor($ms / 1000);
			$ms %= 1000;
			$seconds = (float) $seconds . '.' . $ms;
			if ($neg === true) $seconds *= -1;
		} else {
			$seconds += ($minutes * 60) + ($hours * 60 * 60);
		}
		return $seconds;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::timer()
	 * 
	 * @param bool $lap - Timer lap
	 * @return float - microtime
	 * ----------------------------------------------------------------------*/
	public function timer(bool $lap = false): float {
		if ($this->time == 0.0) {
			$this->time = microtime(true);
		} else {
			$elapsed = microtime(true) - $this->time;
			if (!$lap) $this->time = 0.0;
			$dp = (int) (($this->getConfig('dp') >= 5) || ($this->config['override'] === true) ? $this->getConfig('dp') : 5);
			return $this->decimals($elapsed, $dp);
		}
		return 0.0;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::timestamp()
	 * 
	 * @param ?string $date - Date (optional)
	 * @return int|bool - timestamp
	 * ----------------------------------------------------------------------*/
	public function timestamp(?string $date = null): int|bool {
		if ($date !== null) return strtotime($date);
		return time();
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::timeString()
	 * 
	 * @param mixed $seconds - Seconds or timecode to convert
	 * @return string - Time as string
	 * ----------------------------------------------------------------------*/
	public function timeString(mixed $seconds = 0): string {
		if ($this->isTimeCode($seconds)) $seconds = $this->timecodeConvert($seconds);
		$neg = false;
		$ms = 0;
		if ($this->isDecimal($seconds, $match)) {
			$neg = (bool) $match['negative'];
			$ms = (int) str_pad(strval($match['whole']), 3, '0', STR_PAD_RIGHT);
			$seconds = (int) $match['number'];
			if ($ms >= 1000) {
				$seconds += (int) floor($ms / 1000);
				$ms %= 1000;
			}
		} else {
			$neg = (bool) ($seconds < 0);
			$seconds = (int) abs($seconds);
		}
		$map = [
			3600 => ['hour', 'hr'],
			60 => ['minute', 'min'],
			1 => ['second', 'sec']
		];
		$parts = [];
		$remaining = (int) $seconds;
		foreach ($map as $div => $units) {
			$val = intdiv($remaining, $div);
			if ($val > 0) {
				$label = ($this->config['abbr']? $units[1] : $units[0]);
				if ($val > 1) $label = $label . 's';
				$parts[] = "$val $label";
			}
			$remaining %= $div;
		}
		if ($ms > 0) $parts[] = $ms . ($this->config['abbr']? ' ms' : ' milliseconds');
		$res = implode(' ', $parts) ?: ($this->config['abbr']? '0 sec' : '0 seconds');
		return ($neg === true? '-' : '') . $res;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::timeString()
	 * 
	 * @param mixed $args - List or array of timecodes or time values
	 * @return string - Sum of time values as timecode
	 * ----------------------------------------------------------------------*/
	public function timeSum(mixed ...$args): string {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		for ($x = 0; $x < count($args); $x++) {
			if ($this->isTimecode($args[$x])) {
				$args[$x] = $this->timecodeConvert($args[$x]);
			} else {
				$args[$x] = $this->timeConvert($args[$x]);
			}
		}
		return $this->timecode(array_sum($args));
	}
	
	/* ----------------------------------------------------------------------
	 * Financial
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::timeString()
	 * 
	 * @param float $balance - Account balance
	 * @param float $apr - Annual percentage rate
	 * @param int $days - Billing cycle
	 * @param int $daysInYear - Annual rate divisor
	 * @param bool $asString - Return as string
	 * @return string|float - Interest rate
	 * ----------------------------------------------------------------------*/
	// TODO: Make international
	public function interest(float $balance = 0.0, float $apr = 12.0, int $days = 30, int $daysInYear = 365, bool $asString = false): string|float {
		if (($balance <= 0) || ($days <= 0)) {
			$interest = 0.0;
		} else {
			$dailyRate = ($apr / 100) / $daysInYear;
			$interest = $balance * $dailyRate * $days;
		}
		if ($asString === true) return '$' . $this->decimals($interest, 2, true);
		return $this->decimals($interest, 2);
	}
	
	/* ----------------------------------------------------------------------
	 * Formulas
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::kmh()
	 * 
	 * @param int|float $distance - Distance traveled in meters
	 * @param int|float $time - Travel time in seconds
	 * @param bool $asString - Return as string
	 * @return string|float $speed - Traveling speed in km/h
	 * ----------------------------------------------------------------------*/
	public function kmh(int|float $distance = 0, int|float $time = 60, bool $asString = false): string|float {
		if ($distance <= 0 || $time <= 0) $this->error('Arguments must be greater than zero!', 'warning');
		$kmh = ($distance / $time) * (3600 / 1000);
		if ($string === true) return $this->decimals($kmh, $this->config['dp'], true) . ' km/h';
		return $this->decimals($kmh, $this->config['dp']);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::mph()
	 * 
	 * @param int|float $distance - Distance traveled in feet
	 * @param int|float $time - Travel time in seconds
	 * @param bool $asString - Return as string
	 * @return string|float $speed - Traveling speed in mph
	 * ----------------------------------------------------------------------*/
	public function mph(int|float $distance = 0, int|float $time = 60, bool $asString = false): string|float {
		if ($distance <= 0 || $time <= 0) $this->error('Arguments must be greater than zero!', 'warning');
		$mph = ($distance / $time) * (3600 / 5280);
		if ($string === true) return $this->decimals($mph, $this->config['dp'], true) . ' mph';
		return $this->decimals($mph, $this->config['dp']);
	}
	
	/* ----------------------------------------------------------------------
	 * Mathematical
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::average() - Alias of mean()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return float - Average of values
	 * ----------------------------------------------------------------------*/
	public function average(array|int|float ...$args): float {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		return $this->mean($args);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::diff()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return mixed - Difference of values
	 * ----------------------------------------------------------------------*/
	public function diff(array|int|float ...$args): float {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		$x = array_shift($args);
		$y = array_reduce($args, function($a, $b) {
			return $a - $b;
		}, $x);
		return $this->decimals($y);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::factors()
	 * 
	 * @param int $num - Positive integer to factor
	 * @param bool $prime - Return prime factors
	 * @return array - Array containing all factors of the number
	 * ----------------------------------------------------------------------*/
	public function factors(int $num = 1, bool $prime = false): array {
		if (!is_int($num) || ($num <= 0)) $this->error('Positive integers only!', 'warning');
		$factors = [];
		$sqrt = sqrt($num);
		if ($prime === true) {
			while ($this->mod($num, 2) == 0) {
				$factors[] = 2;
				$num /= 2;
			}
			$d = 3;
			while (($d * $d) <= $num) {
				while ($this->mod($num, $d) == 0) {
					$factors[] = $d;
					$num /= $d;
				}
				$d += 2;
			}
			if ($num > 1) $factors[] = $num;
			if (count($factors) == 1) array_unshift($factors, 1);
		} else {
			for ($x = 1; $x <= $sqrt; $x++) {
				if ($this->mod($num, $x) == 0) {
					$factors[] = $x;
					if ($x !== ($num / $x)) $factors[] = (int) ($num / $x);
				}
			}
			sort($factors);
		}
		return $factors;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::gcd()
	 * 
	 * @param int $a - First number as integer
	 * @param int $b - Second number as integer
	 * @return int - Greatest Common Divisor as integer
	 * ----------------------------------------------------------------------*/
	public function gcd(int $a = 1, int $b = 0): int {
		return ($b ? $this->gcd($b, ($a % $b)) : abs($a));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::gcf()
	 * 
	 * @param array|int $args - List or array of integers
	 * @return int - Greatest Common Factor as integer
	 * ----------------------------------------------------------------------*/
	public function gcf(array|int ...$args): int {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		$gcf = (int) array_shift($args);
		foreach ($args as $b) {
			if ($gcf === 1) break;
			$gcf = $this->gcd($gcf, (int) $b);
		}
		return $gcf;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::lcm()
	 * 
	 * @param array|int $args - List or array of integers
	 * @return int - Least Common Multiple as integer
	 * ----------------------------------------------------------------------*/
	public function lcm(array|int ...$args): int {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		$lcm = (int) array_shift($args);
		foreach ($args as $b) {
			if (($lcm === 0) || ($b === 0)) break;
			$lcm = abs($lcm * ((int) $b / $this->gcd($lcm, (int) $b)));
		}
		return $lcm;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::mean()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return float - Median of values
	 * ----------------------------------------------------------------------*/
	public function mean(array|int|float ...$args): float {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		return $this->decimals($this->sum($args) / count($args));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::median()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return float - Mean of values
	 * ----------------------------------------------------------------------*/
	public function median(array|int|float ...$args): float {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		$sort = sort($args);
		$count = count($args);
		if (($count % 2) == 0) {
			$y = $count / 2;
			$x = $y - 1;
			$median = $this->mean($args[$x], $args[$y]);
		} else {
			$x = (($count + 1) / 2) - 1;
			$median = $args[$x];
		}
		return $median;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::midrange()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return float - Midrange of values
	 * ----------------------------------------------------------------------*/
	public function midrange(array|int|float ...$args): float {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		$min = min($args);
		$max = max($args);
		return $this->decimals($this->mean($min, $max));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::mod()
	 * 
	 * @param string|int|float $n - Numerator as integer or float
	 * @param int $d - Denominator as integer or float
	 * @return int - Remainder as integer
	 * ----------------------------------------------------------------------*/
	public function mod(string|int|float $n = 0, int|float $d = 1): float {
		if (preg_match(self::FRACTIONREGEX, "$n", $match)) {
			$n = $match[1];
			$d = $match[2];
		}
		if ($d == 0) {
			$this->error('Invalid denominator!', 'warning');
			return 0;
		}
		return (is_float($n) || is_float($d)? $this->decimals(fmod($n, $d)) : ($n % $d));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::mode()
	 * 
	 * @param array|int $args - List or array of integers
	 * @return int|array - Mode as integer or modes as array
	 * ----------------------------------------------------------------------*/
	public function mode(array|int ...$args): int|array {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		if (array_any($args, function($arg) {
			return (!is_numeric($arg) || is_float($arg));
		}) === true) {
			$this->error('Invalid arguments! Only whole numbers allowed.', 'warning');
			return false;
		}
		$args = array_count_values($args);
		$max = max($args);
		if ($max == 1) return 0;
		$args = array_filter($args, function($arg) use ($max) {
			if ($arg == $max) return true;
			return false;
		});
		if (count($args) == 1) {
			return (int) $this->flipArray($args)[$max];
		} else {
			$args = array_keys($args);
			$sort = sort($args);
			return $args;
		}
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::product()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return float - Product of values
	 * ----------------------------------------------------------------------*/
	public function product(array|int|float ...$args): float {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		$x = array_shift($args);
		foreach ($args as $arg) {
			$x *= $arg;
		}
		return $this->decimals($x);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::quotient()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return float - Quotient as integer or float
	 * ----------------------------------------------------------------------*/
	public function quotient(array|int|float ...$args): float {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if (!$args) return 0;
		$x = array_shift($args);
		foreach ($args as $arg) {
			if ($arg == 0) {
				$this->error('Division by zero is invalid!', 'warning');
				return false;
			}
			$x /= $arg;
		}
		return $this->decimals($x);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::spread()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return float - The spread between min and max
	 * ----------------------------------------------------------------------*/
	public function spread(array|int|float ...$args): float {
		if (isset($args[0]) && is_array($args[0])) $args = $args[0];
		if (empty($args)) return 0;
		return $this->decimals(max($args) - min($args));
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::sum()
	 * 
	 * @param array|int|float $args - List or array of integers and/or floats
	 * @return float - Sum of values
	 * ----------------------------------------------------------------------*/
	public function sum(array|int|float ...$args): float {
		if (isset($args[0]) && is_array($args[0])) $args = $args[0];
		if (empty($args)) return 0;
		return $this->decimals(array_sum($args));
	}
	
	/* ----------------------------------------------------------------------
	 * Validation
	 * ----------------------------------------------------------------------*/
	
	// TODO: alphaMatch
	// TODO: alphaNumMatch
	// TODO: alphaStart
	// TODO: doubleSyms
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::isDecimal()
	 * 
	 * @param mixed $num - Number to validate
	 * @param array &$matches - Returns matches in decimal as associative array (passed by reference)
	 * @return bool - True if decimal
	 * ----------------------------------------------------------------------*/
	public function isDecimal(mixed $num, ?array &$matches = []): bool {
		if (preg_match(self::DECIMALREGEX, "$num", $match)) {
			$neg = (int) (isset($match[1]) && ($match[1] == '-')? 1 : 0);
			$matches['negative'] = $neg;
			$matches['number'] = (int) $match[2];
			$matches['decimal'] = (float) $match[3];
			$matches['whole'] = (int) $match[4];
			$matches['match'] = $match[0];
			return true;
		}
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::isEmail()
	 * 
	 * @param mixed $email - Email Address to validate
	 * @param array &$matches - Returns matches in email address as associative array (passed by reference)
	 * @return bool - True if valid email address
	 * ----------------------------------------------------------------------*/
	public function isEmail(mixed $email, ?array &$matches = []): bool {
		if (preg_match(self::EMAILREGEX, "$email", $match) && !preg_match(self::DOUBLEDOTS, $email)) {
			list($e, $local, $domain) = $match;
			$matches['email'] = $e;
			$matches['local'] = $local;
			$matches['domain'] = $domain;
			return true;
		} else if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
			$match = preg_split('/@(?!.*@)/', $email);
			$matches['email'] = $email;
			$matches['local'] = $match[0];
			$matches['domain'] = $match[1];
			return true;
		}
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::isPhone()
	 * 
	 * @param mixed $phone - Phone Number to validate
	 * @param array &$matches - Returns matches in phone number as associative array (passed by reference)
	 * @return bool - True if valid phone number
	 * ----------------------------------------------------------------------*/
	public function isPhone(mixed $phone, ?array &$matches = []): bool {
		$matches = [];
		if (!is_string($phone) && !is_numeric($phone)) {
			return false;
		}
		$phone = trim((string)$phone);
		if (str_starts_with($phone, '+')) {
			if (str_contains($phone, '(0)')) return false;
			if (preg_match('/^\+([0-9\s\-\.\(\)]{6,22})(?:[\s]?(?:x|ext[\.]?)[\s]?(\d+))?$/i', $phone, $match)) {
				$rawNumber = $match[1];
				$allDigits = preg_replace('/\D/', '', $rawNumber);
				$ext = $match[2] ?? '';
				$cc = null;
				$national = '';
				if (preg_match('/^\+\s*(\d{1,3})[\s\-\.\)]/', $phone, $prefixMatch)) {
					$delimitedCc = $prefixMatch[1];
					if (in_array($delimitedCc, $this->countrycodes, true)) {
						$cc = $delimitedCc;
						$national = substr($allDigits, strlen($cc));
					} else {
						return false;
					}
				} else {
					foreach ([3, 2, 1] as $len) {
						$candidate = substr($allDigits, 0, $len);
						if (in_array($candidate, $this->countrycodes, true)) {
							$cc = $candidate;
							$national = substr($allDigits, $len);
							break;
						}
					}
				}
				if ($cc === null || str_starts_with($national, '0')) {
					return false;
				}
				if ($cc === '1') {
					if (strlen($national) !== 10) {
						return false;
					}
					$area = substr($national, 0, 3);
					$prefix = substr($national, 3, 3);
					$line = substr($national, 6, 4);
					$formattedPhone = "+1 ({$area}) {$prefix}-{$line}";
				} else {
					if (strlen($national) < 6 || strlen($national) > 12) {
						return false;
					}
					$area = '';
					$prefix = '';
					$line = '';
					$formattedPhone = "+{$cc} {$national}";
				}
				$matches['phone'] = $formattedPhone;
				$matches['cc'] = $cc;
				$matches['area'] = $area;
				$matches['prefix'] = $prefix;
				$matches['line'] = $line;
				$matches['national'] = $national;
				$matches['ext'] = $ext;
				$matches['e164'] = '+' . $cc . $national;
				return true;
			}
			return false;
		}
		if (preg_match(self::PHONEREGEX, $phone, $match)) {
			list($num, $cc, $area, $prefix, $line, $ext) = array_pad($match, 6, '');
			$cctld = $cc ?: '1';
			$matches['phone'] = '+' . $cctld . ' (' . $area . ') ' . $prefix . '-' . $line;
			$matches['cc'] = $cctld;
			$matches['area'] = $area;
			$matches['prefix'] = $prefix;
			$matches['line'] = $line;
			$matches['national'] = $area . $prefix . $line;
			$matches['ext'] = $ext;
			$matches['e164'] = '+' . $cctld . $area . $prefix . $line;
			return true;
		}
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::isSqlTimestamp()
	 * 
	 * @param mixed $date - SQL Timestamp to validate
	 * @param array &$matches - Returns matches in SQL timestamp as associative array (passed by reference)
	 * @return bool - True if SQL timestamp
	 * ----------------------------------------------------------------------*/
	public function isSqlTimestamp(mixed $date, ?array &$matches = []): bool {
		if (preg_match(self::SQLTSREGEX, "$date", $match)) {
			list($m, $year, $month, $day, $hour, $min, $sec) = $match;
			$ts = $this->timestamp($date);
			$matches['timestamp'] = $ts;
			$matches['year'] = $year;
			$matches['month'] = $month;
			$matches['day'] = $day;
			$matches['hour'] = $hour;
			$matches['min'] = $min;
			$matches['sec'] = $sec;
			$matches['match'] = $m;
			return checkdate((int) $month, (int) $day, (int) $year);
		}
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFX::isTimecode()
	 * 
	 * @param mixed $time - Timecode
	 * @param array &$matches - Returns matches in timecode as associative array (passed by reference)
	 * @return bool true|false - True if timecode
	 * ----------------------------------------------------------------------*/
	public function isTimecode(mixed $time, ?array &$matches = []): bool {
		if (preg_match(self::TIMECODEREGEX, "$time", $match)) {
			$neg = (int) (isset($match[1]) && ($match[1] == '-')? 1 : 0);
			$hours = (int) ($match[2] != ''? $match[2] : 0);
			$minutes = (int) ($match[3] != ''? $match[3] : 0);
			$seconds = (int) ($match[5] != ''? $match[5]: 0);
			$ms = (int) (isset($match[6]) && ($match[6] != '')? str_pad($match[6], 3, '0', STR_PAD_RIGHT) : 0);
			if ($ms >= 1000) {
				$seconds += (int) floor($ms / 1000);
				$ms %= 1000;
			}
			if ($seconds >= 60) {
				$minutes += intdiv($seconds, 60);
				$seconds = $seconds % 60;
			}
			if ($minutes >= 60) {
				$hours += intdiv($minutes, 60);
				$minutes = $minutes % 60;
			}
			$matches['negative'] = $neg;
			$matches['hours'] = $hours;
			$matches['minutes'] = $minutes;
			$matches['seconds'] = $seconds;
			$matches['ms'] = $ms;
			$matches['timecode'] = ($neg == 1? '-' : '') . $this->timecode($seconds, $minutes, $hours, $ms);
			return true;
		}
		return false;
	}
	
	// TODO: numMatch
	// TODO: validLength
	// TODO: validMatch
    
}

?>
