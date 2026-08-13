<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreySecurity
 * @file		CoreySecurity.php
 * ---------------------------------------------------------------------*/
declare(strict_types=1);

class CoreySecurity extends CoreyPHP {

    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    public private(set) string $algo = '';

    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    private array $algorithms = [];
    private array $blacklist = ['corey', 'password', 'pass', 'default', 'admin', 'master', 'welcome', 'user', 'guest', 'login', 'signin', 'access', 'root', 'database', 'system', 'secret', 'love', 'sex', 'god', 'blank', 'wizard', 'guru', 'qwerty', 'testing', 'football', 'baseball', 'iloveyou', 'changeme', 'monkey', 'dragon', 'shadow', 'princess', 'forever', 'hunter', 'superman', 'batman', 'wizard', 'pokemon', 'spring', 'summer', 'autumn', 'winter', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december', 'newyears', 'president', 'memorial', 'independence', 'laborday', 'columbus', 'veterans', 'thanksgiving', 'christmas', 'easter', 'halloween', 'company', 'office', 'business', 'work'];

    /* ----------------------------------------------------------------------
	 * Constants / Regular Expressions - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
    protected const CONSLOWERCASE = '/\p{Ll}(?=\p{Ll})/u';
    protected const CONSUPPERCASE = '/\p{Lu}(?=\p{Lu})/u';
    protected const CONSNUMBERS = '/\d(?=\d)/u';
	protected const DATEFORMREGEX = '/(?:\d{2}[\/\.\-\s]\d{2}[\/\.\-\s]\d{2,4})|(?:\d{4}[\/\.\-\s]\d{2}[\/\.\-\s]\d{2})/';
    protected const LETTERSLIST = 'abcdefghijklmnopqrstuvwxyz';
    protected const LETTERSONLY = '/^\p{L}+$/uD';
	protected const LETTERSREGEX = '/\p{Ll}/u';
    protected const NONLETTERREGEX = '/[\d\p{S}\p{P}]/u';
	protected const NUMBERSLIST = '0123456789';
    protected const NUMBERSONLY = '/^\d+$/uD';
	protected const NUMBERSREGEX = '/\d/u';
    protected const REPEATREGEX = '/(.)(?=\1)/';
    protected const SEQNUMREGEX = '/\d{4}/u';
    protected const SEQNUMSFORWARD = '0123456789012';
    protected const SEQNUMSREVERSE = '2109876543210';
	protected const SIMILARLIST = '0Oo1lI';
	protected const SIMPLEEMAILREGEX = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}\b/';
	protected const SIMPLEPHONEREGEX = '/(?:\(\d{3}\)\s|\d{3}[\.\-])\d{3}[\.\-]\d{4}/';
	protected const SYMBOLSAFELIST = '!@#$%^*+-=_.,?:;()';
	protected const SYMBOLSREGEX = '/[^\p{L}\p{N}\s]/u';
	protected const UPPERCASEREGEX = '/\p{Lu}/u';
	
	/* ----------------------------------------------------------------------
	 * Core
	 * ----------------------------------------------------------------------*/

    /* ----------------------------------------------------------------------
	 * CoreySecurity::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		$defaults = [
            'algorithm' => 'sha256',
			'debug' => true,
            'exclude' => [
				'similar' => true
			],
            'exclusion' => '',
            'minLength' => 8,
            'numbers' => true,
			'override' => false,
            'symbols' => true,
            'uppercase' => true
		];
		$this->config = array_merge($defaults, $this->config);
		parent::__construct($userConfig);
        $this->setAlgorithm((string) $this->getConfig('algorithm'));
	}
	
	/* ----------------------------------------------------------------------
	 * Config
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::loadCustomBlacklist()
	 * 
	 * @param array $words - Blacklist words to add
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Add file option to load more blacklist words
	public function loadCustomBlacklist(array $words): static {
    	$this->blacklist = array_unique(array_merge($this->blacklist, array_map('strtolower', $words)));
    	return $this;
	}
    
    /* ----------------------------------------------------------------------
	 * Structure
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::getAlgorithm()
	 * 
	 * @param bool $refresh - Refresh the list
	 * @return array - Algorithm list
	 * ----------------------------------------------------------------------*/
    public function getAlgorithm(): string {
        if ($this->algorithmExists($this->algo)) {
            return $this->algo;
        }
        $default = (string) $this->getConfig('algorithm');
        if ($this->algorithmExists($default)) {
            return $default;
        }
        return 'sha256';
    }
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::listAlgorithms()
	 * 
	 * @param bool $refresh - Refresh the list
	 * @return array - Algorithm list
	 * ----------------------------------------------------------------------*/
    public function listAlgorithms(bool $refresh = false): array {
        if (empty($this->algorithms) || ($refresh === true)) $this->algorithms = hash_algos();
        return $this->algorithms;
    }
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::setAlgorithm()
	 * 
	 * @param string $algo - Algorithm to set
	 * @return $this
	 * ----------------------------------------------------------------------*/
    public function setAlgorithm(string $algo): static {
        $algo = strtolower(trim($algo));
        if ($this->algorithmExists($algo)) {
            $this->algo = $algo;
            return $this;
        }
        $default = strtolower(trim($this->getConfig('algorithm')));
        if ($this->algorithmExists($default)) {
            $this->algo = $default;
        } else {
            $this->algo = 'sha256';
        }
        return $this;
    }
    
    /* ----------------------------------------------------------------------
	 * Generators
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::credentialGen()
	 * 
	 * @param int $passLength - Password length
	 * @param ?string $algo - Alternate hashing algorithm to use
	 * @return array - Array containing credentials
	 * ----------------------------------------------------------------------*/
    public function credentialGen(int $passLength = 16, ?string $algo = null): array {
        $password = $this->passGen($passLength);
        $salt = $this->saltGen();
        $hash = $this->passHash($password, $salt, $algo);
        $algorithm = ($algo !== null)? strtolower(trim($algo)) : $this->getAlgorithm();
        return [
            'password' => $password,
            'salt' => $salt,
            'hash' => $hash,
            'algorithm' => $algorithm
        ];
    }
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::idGen()
	 * 
	 * @param int $len - ID length
	 * @param ?string $prefix - Optional string to prepend to ID
	 * @return string - Generated ID
	 * ----------------------------------------------------------------------*/
	public function idGen(int $len = 12, ?string $prefix = null): string {
		$minLength = $this->getConfig('minLength');
		if ($len < $minLength) $len = $minLength;
		$prefix = ($prefix !== null? trim($prefix) : '');
		$prefixLength = strlen($prefix);
		$numericLength = max(4, $len - $prefixLength);
		$pool = self::NUMBERSLIST;
		$poolLength = strlen($pool);
		$id = '';
		for ($x = 0; $x < $numericLength; $x++) {
			if (($x === 0) && ($prefix === '')) {
				$id .= $pool[random_int(1, $poolLength - 1)];
			} else {
				$id .= $pool[random_int(0, $poolLength - 1)];
			}
		}
		return $prefix . $id;
	}
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::passGen()
	 * 
	 * @param int $len - Password length
	 * @param string $exclusions - Letters, numbers or symbols to exclude
	 * @return string - Generated password
	 * ----------------------------------------------------------------------*/
	// TODO: Make option to specify what password is needed for: ex. WEP Key: (0-9,A-F)
	// TODO: Add options to make generated password meet password guidelines, ex. not start with a letter
	public function passGen(int $len = 16, string $exclusions = ''): string {
		$minLength = $this->getConfig('minLength');
		if ($len < $minLength) $len = $minLength;
		$pool = self::LETTERSLIST;
		if ($this->getConfig('uppercase') === true) $pool .= strtoupper(self::LETTERSLIST);
		if ($this->getConfig('numbers') === true) $pool .= self::NUMBERSLIST;
		if ($this->getConfig('symbols') === true) $pool .= $this->getSymbols();
		$exclude = [];
		if ($this->getConfig('exclude.similar') === true) $exclude = array_merge($exclude, str_split(self::SIMILARLIST));
		if (!empty($exclusions)) $exclude = array_merge($exclude, str_split($exclusions));
		if (!empty($exclude)) $pool = str_replace(array_unique($exclude), '', $pool);
		$poolLength = strlen($pool);
		if ($poolLength === 0) {
			$this->error('Character pool is completely empty due to exclusions!', 'error');
			return '';
		}
		$this->validatePool($pool);
		$loops = 0;
		do {
			$pw = '';
			for ($x = 0; $x < $len; $x++) {
				$pw .= $pool[random_int(0, $poolLength - 1)];
			}
			$loops++;
			if ($loops >= 100) {
				$this->error('Password generator timeout after too many attempts!', 'error');
				$pw = '';
				break;
			}
		} while ($this->passCheck($pw) === false);
		return $pw;
	}
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::saltGen()
	 * 
	 * @param int $len - Salt length
	 * @return string - Generated salt
	 * ----------------------------------------------------------------------*/
	// TODO: Use passchk in downloads to add frequency and commonality
	public function saltGen(int $len = 32): string {
		$len = max(32, $len);
		$byteLength = (int) ceil($len / 2);
		$salt = bin2hex(random_bytes($byteLength));
		return $salt;
	}
    
    /* ----------------------------------------------------------------------
	 * Hashing
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::hash()
	 * 
	 * @param string $data - The plain text data to hash
	 * @param ?string $algo - Alternate hashing algorithm to use
	 * @return string - The resulting hash
	 * ----------------------------------------------------------------------*/
    public function hash(string $data, ?string $algo = null): string {
        if ($algo !== null) {
            $algo = strtolower(trim($algo));
            if (!$this->algorithmExists($algo)) {
                $this->error('The algorithm "' . $algo . '" is not available on this server!', 'error');
                return $this->errorHash();
            }
        } else {
            $algo = $this->getAlgorithm();
        }
        return hash($algo, $data);
    }
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::passHash()
	 * 
	 * @param string $pw - The password to hash
	 * @param string $salt - The salt to add to password for hashing
	 * @param ?string $algo - Alternate hashing algorithm to use
	 * @return string - The hashed password
	 * ----------------------------------------------------------------------*/
    public function passHash(string $pw, string $salt, ?string $algo = null): string {
        if ($pw === '') {
            $this->error('Password is required to hash!', 'error');
            return $this->errorHash();
        }
        if ($salt === '') {
            $this->error('All passwords should have a salt!', 'warning');
            return $this->errorHash();
        }
        $salted = $salt . $pw;
        return $this->hash($salted, $algo);
    }
    
    /* ----------------------------------------------------------------------
	 * Metrics
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::passEntropy()
	 * 
	 * @param string $pw - Password
	 * @param bool $format - Appends bits
	 * @param string &$complexity - Entropy complexity (passed by reference)
	 * @return string|float - Entropy of password in bits
	 * ----------------------------------------------------------------------*/
	// TODO: Check for common substitutions, repeating characters
	public function passEntropy(string $pw, bool $format = false, ?string &$complexity = null): string|float {
		if ($pw === '') $this->error('Invalid password!', 'error');
		$entropy = 0;
		$pool = 26;
		$pool += ($this->getConfig('uppercase') === true)? 26 : 0;
		$pool += ($this->getConfig('numbers') === true)? 10 : 0;
		if ($this->getConfig('exclude.similar') === true) {
			$sub = 0;
			$sub += preg_match_all(self::LETTERSREGEX, self::SIMILARLIST);
			if ($this->getConfig('uppercase') === true) $sub += preg_match_all(self::UPPERCASEREGEX, self::SIMILARLIST);
			if ($this->getConfig('numbers') === true) $sub += preg_match_all(self::NUMBERSREGEX, self::SIMILARLIST);
			$pool -= $sub;
		}
		$pool += ($this->getConfig('symbols') === true)? strlen($this->getSymbols()) : 0;
		if ($pool <= 1) {
			$complexity = 'Zero Entropy!';
			return $format ? '0 bits' : (float) 0.0;
		}
		$entropy = $this->decimals(strlen($pw) * log($pool, 2), 2);
		$complexity = match(true) {
			($entropy >= 128)	=> 'Excellent',
			($entropy >= 100)	=> 'Very Strong',
			($entropy >= 80)	=> 'Strong',
			($entropy >= 60)	=> 'Good',
			($entropy >= 36)	=> 'Fair',
			($entropy >= 28)	=> 'Weak',
			default 			=> 'Very Weak'
		};
		return $format ? $entropy . ' bits' : (float) $entropy;
	}
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::passStrength()
	 * 
	 * @param string $pw - Password
	 * @param string &$data - Strength data (passed by reference)
	 * @return string - Strength of password
	 * ----------------------------------------------------------------------*/
    // TODO: Zxcvbn and HaveIBeenPwned
	public function passStrength(string $pw, ?array &$data = []): string {
        $pwLength = strlen($pw);
        $minLength = $this->getConfig('minLength');
        $pwLower = strtolower($pw);
        $keyboardPaths = ['qwertyuiop', 'asdfghjkl', 'zxcvbnm', '1qaz', '2wsx', '3edc', '4rfv', '5tgb', '6yhn', '7ujm', '8ik', '9ol'];
        $tests = [];
        /* --------------------------------------------------
		 * Length of Password
		 * -------------------------------------------------- */
        $lenScore = $pwLength * 4;
        $lenStrength = $this->scoreStrength($lenScore, 'add');
        $lenCode = ($pwLength < $minLength? -1 : ($pwLength > $minLength? 2 : 1));
        $lenReq = ($pwLength >= $minLength? 1 : 0);
        $lenReqScore = $lenReq * 2;
        $lenReqStrength = $this->scoreStrength($lenReqScore, 'add');
        $lenReqCode = ($lenReq == 1? 3 : -1);
        $tests[] = ['Test' => 'Length of Password', 'Category' => 'Additions', 'Count' => $pwLength, 'Score' => $lenScore, 'Strength' => $lenStrength, 'Code' => $lenCode, 'Msg' => $this->passCodeMsg($lenCode)];
        /* --------------------------------------------------
		 * Lowercase Letters
		 * -------------------------------------------------- */
        $lowerCount = preg_match_all(self::LETTERSREGEX, $pw);
        $lowerScore = ($lowerCount > 0? $lowerCount * 2 : 0);
        $lowerStrength = $this->scoreStrength($lowerScore, 'add');
        $lowerCode = ($lowerCount <= 0? -1 : ($lowerCount >= 2? 2 : 1));
        $lowerReq = ($lowerCount > 0? 1 : 0);
        $lowerReqScore = $lowerReq * 2;
        $lowerReqStrength = $this->scoreStrength($lowerReqScore, 'add');
        $lowerReqCode = ($lowerReq == 1? 3 : -1);
        $tests[] = ['Test' => 'Lowercase Letters', 'Category' => 'Additions', 'Count' => $lowerCount, 'Score' => $lowerScore, 'Strength' => $lowerStrength, 'Code' => $lowerCode, 'Msg' => $this->passCodeMsg($lowerCode)];
        /* --------------------------------------------------
		 * Uppercase Letters
		 * -------------------------------------------------- */
        $upperCount = preg_match_all(self::UPPERCASEREGEX, $pw);
        $upperScore = (($upperCount > 0) && ($upperCount < $pwLength)? ($pwLength - $upperCount) * 2 : 0);
        $upperStrength = $this->scoreStrength($upperScore, 'add');
        $upperCode = ($upperCount <= 0? -1 : ($upperCount >= 2? 2 : 1));
        $upperReq = ($upperCount > 0? 1 : 0);
        $upperReqScore = $upperReq * 2;
        $upperReqStrength = $this->scoreStrength($upperReqScore, 'add');
        $upperReqCode = ($upperReq == 1? 3 : -1);
        $tests[] = ['Test' => 'Uppercase Letters', 'Category' => 'Additions', 'Count' => $upperCount, 'Score' => $upperScore, 'Strength' => $upperStrength, 'Code' => $upperCode, 'Msg' => $this->passCodeMsg($upperCode)];
        /* --------------------------------------------------
		 * Numbers
		 * -------------------------------------------------- */
        $numCount = preg_match_all(self::NUMBERSREGEX, $pw);
        $numScore = (($numCount > 0) && ($numCount < $pwLength)? $numCount * 4 : 0);
        $numStrength = $this->scoreStrength($numScore, 'add');
        $numCode = (($numCount <= 0) || ($numCount === $pwLength)? -1 : ($numCount >= 2? 2 : 1));
        $numReq = ($numCount > 0? 1 : 0);
        $numReqScore = $numReq * 2;
        $numReqStrength = $this->scoreStrength($numReqScore, 'add');
        $numReqCode = ($numReq == 1? 3 : -1);
        $tests[] = ['Test' => 'Numbers', 'Category' => 'Additions', 'Count' => $numCount, 'Score' => $numScore, 'Strength' => $numStrength, 'Code' => $numCode, 'Msg' => $this->passCodeMsg($numCode)];
        /* --------------------------------------------------
		 * Symbols
		 * -------------------------------------------------- */
        $symCount = preg_match_all(self::SYMBOLSREGEX, $pw);
        $symScore = $symCount * 6;
        $symStrength = $this->scoreStrength($symScore, 'add');
        $symCode = ($symCount <= 0? -1 : ($symCount >= 2? 2 : 1));
        $symReq = ($symCount > 0? 1 : 0);
        $symReqScore = $symReq * 2;
        $symReqStrength = $this->scoreStrength($symReqScore, 'add');
        $symReqCode = ($symReq == 1? 3 : -1);
        $tests[] = ['Test' => 'Symbols', 'Category' => 'Additions', 'Count' => $symCount, 'Score' => $symScore, 'Strength' => $symStrength, 'Code' => $symCode, 'Msg' => $this->passCodeMsg($symCode)];
        /* --------------------------------------------------
		 * Middle Numbers or Symbols
		 * -------------------------------------------------- */
        $midChars = ($pwLength > 2? substr($pw, 1, -1) : '');
        $midCount = preg_match_all(self::NONLETTERREGEX, $midChars);
        $midScore = ($pwLength >= 3? $midCount * 2 : 0);
        $midStrength = $this->scoreStrength($midScore, 'add');
        $midCode = ($midCount <= 0? -1 : ($midCount >= 2? 2 : 1));
        $tests[] = ['Test' => 'Middle Numbers or Symbols', 'Category' => 'Additions', 'Count' => $midCount, 'Score' => $midScore, 'Strength' => $midStrength, 'Code' => $midCode, 'Msg' => $this->passCodeMsg($midCode)];
        /* --------------------------------------------------
		 * Requirements
		 * -------------------------------------------------- */
        $reqTotal = $lenReq + $lowerReq + $upperReq + $numReq + $symReq;
        $reqScore = (($lenReq === 1) && ($reqTotal >= 3)? $reqTotal * 2 : 0);
        $reqStrength = $this->scoreStrength($reqScore, 'add');
        $reqCode = ($reqTotal <= 3? -1 : ($reqTotal >= 5? 2 : 1));
        $requirements = [];
        $requirements[] = ['Requirement' => 'Minimum Length', 'Count' => $lenReq, 'Score' => $lenReqScore, 'Strength' => $lenReqStrength, 'Code' => $lenReqCode, 'Msg' => $this->passCodeMsg($lenReqCode)];
        $requirements[] = ['Requirement' => 'Lowercase Letters', 'Count' => $lowerReq, 'Score' => $lowerReqScore, 'Strength' => $lowerReqStrength, 'Code' => $lowerReqCode, 'Msg' => $this->passCodeMsg($lowerReqCode)];
        $requirements[] = ['Requirement' => 'Uppercase Letters', 'Count' => $upperReq, 'Score' => $upperReqScore, 'Strength' => $upperReqStrength, 'Code' => $upperReqCode, 'Msg' => $this->passCodeMsg($upperReqCode)];
        $requirements[] = ['Requirement' => 'Numbers', 'Count' => $numReq, 'Score' => $numReqScore, 'Strength' => $numReqStrength, 'Code' => $numReqCode, 'Msg' => $this->passCodeMsg($numReqCode)];
        $requirements[] = ['Requirement' => 'Symbols', 'Count' => $symReq, 'Score' => $symReqScore, 'Strength' => $symReqStrength, 'Code' => $symReqCode, 'Msg' => $this->passCodeMsg($symReqCode)];
        $tests[] = ['Test' => 'Requirements', 'Category' => 'Additions', 'Count' => $reqTotal, 'Score' => $reqScore, 'Strength' => $reqStrength, 'Code' => $reqCode, 'Msg' => $this->passCodeMsg($reqCode), 'Requirements' => $requirements];
        /* --------------------------------------------------
		 * Additions
		 * -------------------------------------------------- */
		$additions = $lenScore + $lowerScore + $upperScore + $numScore + $symScore + $midScore + $reqScore;
		/* --------------------------------------------------
		 * Letters Only
		 * -------------------------------------------------- */
        $letOnlyCount = preg_match(self::LETTERSONLY, $pw);
        $letOnlyScore = ($letOnlyCount == 1? $pwLength * 8 : 0);
        $letOnlyStrength = $this->scoreStrength($letOnlyScore, 'sub');
        $letOnlyCode = ($letOnlyScore == 0? 1 : 0);
        $tests[] = ['Test' => 'Letters Only', 'Category' => 'Deductions', 'Count' => $letOnlyCount, 'Score' => $letOnlyScore, 'Strength' => $letOnlyStrength, 'Code' => $letOnlyCode, 'Msg' => $this->passCodeMsg($letOnlyCode)];
        /* --------------------------------------------------
		 * Numbers Only
		 * -------------------------------------------------- */
        $numOnlyCount = preg_match(self::NUMBERSONLY, $pw);
        $numOnlyScore = ($numOnlyCount == 1? $pwLength * 8 : 0);
        $numOnlyStrength = $this->scoreStrength($numOnlyScore, 'sub');
        $numOnlyCode = ($numOnlyScore == 0? 1 : 0);
        $tests[] = ['Test' => 'Numbers Only', 'Category' => 'Deductions', 'Count' => $numOnlyCount, 'Score' => $numOnlyScore, 'Strength' => $numOnlyStrength, 'Code' => $numOnlyCode, 'Msg' => $this->passCodeMsg($numOnlyCode)];
        /* --------------------------------------------------
		 * Repeating Characters
		 * -------------------------------------------------- */
        $repCount = preg_match_all(self::REPEATREGEX, $pw);
        $repScore = $repCount * 2;
        $repStrength = $this->scoreStrength($repScore, 'sub');
        $repCode = ($repCount == 0? 1 : 0);
        $tests[] = ['Test' => 'Repeating Characters', 'Category' => 'Deductions', 'Count' => $repCount, 'Score' => $repScore, 'Strength' => $repStrength, 'Code' => $repCode, 'Msg' => $this->passCodeMsg($repCode)];
        /* --------------------------------------------------
		 * Consecutive Lowercase Letters
		 * -------------------------------------------------- */
        $consLowerCount = preg_match_all(self::CONSLOWERCASE, $pw);
        $consLowerScore = $consLowerCount * 4;
        $consLowerStrength = $this->scoreStrength($consLowerScore, 'sub');
        $consLowerCode = ($lowerCount == 0? -2 : ($consLowerCount == 0? 1 : 0));
        $tests[] = ['Test' => 'Consecutive Lowercase Letters', 'Category' => 'Deductions', 'Count' => $consLowerCount, 'Score' => $consLowerScore, 'Strength' => $consLowerStrength, 'Code' => $consLowerCode, 'Msg' => $this->passCodeMsg($consLowerCode)];
        /* --------------------------------------------------
		 * Consecutive Uppercase Letters
		 * -------------------------------------------------- */
        $consUpperCount = preg_match_all(self::CONSUPPERCASE, $pw);
        $consUpperScore = $consUpperCount * 4;
        $consUpperStrength = $this->scoreStrength($consUpperScore, 'sub');
        $consUpperCode = ($upperCount == 0? -2 : ($consUpperCount == 0? 1 : 0));
        $tests[] = ['Test' => 'Consecutive Uppercase Letters', 'Category' => 'Deductions', 'Count' => $consUpperCount, 'Score' => $consUpperScore, 'Strength' => $consUpperStrength, 'Code' => $consUpperCode, 'Msg' => $this->passCodeMsg($consUpperCode)];
        /* --------------------------------------------------
		 * Consecutive Numbers
		 * -------------------------------------------------- */
        $consNumCount = preg_match_all(self::CONSNUMBERS, $pw);
        $consNumScore = $consNumCount * 4;
        $consNumStrength = $this->scoreStrength($consNumScore, 'sub');
        $consNumCode = ($numCount == 0? -2 : ($consNumCount == 0? 1 : 0));
        $tests[] = ['Test' => 'Consecutive Numbers', 'Category' => 'Deductions', 'Count' => $consNumCount, 'Score' => $consNumScore, 'Strength' => $consNumStrength, 'Code' => $consNumCode, 'Msg' => $this->passCodeMsg($consNumCode)];
        /* --------------------------------------------------
		 * Sequential Letters
		 * -------------------------------------------------- */
        $seqLetCount = 0;
        for ($x = 0; $x < ($pwLength - 2); $x++) {
            $y1 = ord($pwLower[$x]);
            $y2 = ord($pwLower[$x+1]);
            $y3 = ord($pwLower[$x+2]);
            if (ctype_alpha($pwLower[$x]) && ctype_alpha($pwLower[$x+2])) {
                if ((($y2 == $y1 + 1) && ($y3 == $y2 + 1)) || (($y2 == $y1 - 1) && ($y3 == $y2 - 1))) {
                    $seqLetCount++;
                }
            }
        }
        $seqLetScore = $seqLetCount * 6;
        $seqLetStrength = $this->scoreStrength($seqLetScore, 'sub');
        $seqLetCode = ($numOnlyCount == 1? -2 : ($seqLetCount == 0? 1 : 0));
        $tests[] = ['Test' => 'Sequential Letters', 'Category' => 'Deductions', 'Count' => $seqLetCount, 'Score' => $seqLetScore, 'Strength' => $seqLetStrength, 'Code' => $seqLetCode, 'Msg' => $this->passCodeMsg($seqLetCode)];
        /* --------------------------------------------------
		 * Sequential Numbers
		 * -------------------------------------------------- */
        $seqNumCount = 0;
        $longSeq = false;
        for ($x = 0; $x < ($pwLength - 2); $x++) {
            $y1 = $pw[$x];
            $y2 = $pw[$x+1];
            $y3 = $pw[$x+2];
            if (ctype_digit($y1) && ctype_digit($y2) && ctype_digit($y3)) {
                $z1 = (int) $y1;
                $z2 = (int) $y2;
                $z3 = (int) $y3;
                if ((($z2 == $z1 + 1) && ($z3 == $z2 + 1)) || (($z2 == $z1 - 1) && ($z3 == $z2 - 1))) {
                    $seqNumCount++;
                }
            }
        }
        if (preg_match_all(self::SEQNUMREGEX, $pw, $matches)) {
            foreach ($matches[0] as $chunk) {
                if ((strpos(self::SEQNUMSFORWARD, $chunk) !== false) || (strpos(self::SEQNUMSREVERSE, $chunk) !== false)) {
                    $longSeq = true;
                    break;
                }
            }
        }
        $seqNumScore = $seqNumCount * ($longSeq === true? 8 : 6);
        $seqNumStrength = $this->scoreStrength($seqNumScore, 'sub');
        $seqNumCode = ($letOnlyCount == 1? -2 : ($seqNumCount == 0? 1 : 0));
        $tests[] = ['Test' => 'Sequential Numbers', 'Category' => 'Deductions', 'Count' => $seqNumCount, 'Score' => $seqNumScore, 'Strength' => $seqNumStrength, 'Code' => $seqNumCode, 'Msg' => $this->passCodeMsg($seqNumCode)];
        /* --------------------------------------------------
		 * Sequential Keys
		 * -------------------------------------------------- */
        $seqKeysCount = 0;
        for ($x = 0; $x < ($pwLength - 2); $x++) {
            $chunk = substr($pwLower, $x, 3);
            $revChunk = strrev($chunk);
            foreach ($keyboardPaths as $path) {
                if ((strpos($path, $chunk) !== false) || (strpos($path, $revChunk) !== false)) {
                    $seqKeysCount++;
                    break;
                }
            }
        }
        $seqKeysScore = $seqKeysCount * 6;
        $seqKeysStrength = $this->scoreStrength($seqKeysScore, 'sub');
        $seqKeysCode = ($seqKeysCount == 0? 1 : 0);
        $tests[] = ['Test' => 'Sequential Keys', 'Category' => 'Deductions', 'Count' => $seqKeysCount, 'Score' => $seqKeysScore, 'Strength' => $seqKeysStrength, 'Code' => $seqKeysCode, 'Msg' => $this->passCodeMsg($seqKeysCode)];
		$seqMax = max($seqLetCount, $seqNumCount);
		$seqCap = ($seqMax > 2)? ($seqMax > 3? 40 : 50) : 0;
		/* --------------------------------------------------
		 * Leet-Speak
		 * -------------------------------------------------- */
        $leetMap = ['@' => 'a', '4' => 'a', '3' => 'e', '1' => 'i', '!' => 'i', '0' => 'o', '$' => 's', '5' => 's', '7' => 't'];
        $pwNormal = strtr($pwLower, $leetMap);
        $isBlacklisted = false;
        foreach ($this->blacklist as $root) {
            if (strpos($pwNormal, $root) !== false) {
                $isBlacklisted = true;
                break;
            }
        }
		/* --------------------------------------------------
		 * Email Address Pattern
		 * -------------------------------------------------- */
		$hasEmail = (bool) preg_match(self::SIMPLEEMAILREGEX, $pw);
		/* --------------------------------------------------
		 * Phone Number Pattern
		 * -------------------------------------------------- */
		$hasPhone = (bool) preg_match(self::SIMPLEPHONEREGEX, $pw, $matches);
		$phoneDeduction = 0;
		if ($hasPhone && ($pwLength > 0)) {
			$phoneLen = strlen($matches[0]);
			$phonePercent = $phoneLen / $pwLength;
			$phoneDeduction = (int) round($phonePercent * $additions);
			$phoneStrength = $this->scoreStrength($phoneDeduction, 'sub');
			$phoneCode = -1;
			$tests[] = ['Test' => 'Phone Number Included', 'Category' => 'Deductions', 'Count' => 1, 'Score' => $phoneDeduction, 'Strength' => $phoneStrength, 'Code' => $phoneCode, 'Msg' => $this->passCodeMsg($phoneCode)];
		}
		/* --------------------------------------------------
		 * Birthday / Date Pattern
		 * -------------------------------------------------- */
		$hasDate = (bool) preg_match(self::DATEFORMREGEX, $pw, $matches);
		$dateDeduction = 0;
		if ($hasDate && ($pwLength > 0)) {
			$dateLen = strlen($matches[0]);
			$datePercent = $dateLen / $pwLength;
			$dateDeduction = (int) round($datePercent * $additions);
			$dateStrength = $this->scoreStrength($dateDeduction, 'sub');
			$dateCode = -1;
			$tests[] = ['Test' => 'Birthday / Date Pattern Included', 'Category' => 'Deductions', 'Count' => 1, 'Score' => $dateDeduction, 'Strength' => $dateStrength, 'Code' => $dateCode, 'Msg' => $this->passCodeMsg($dateCode)];
		}
		/* --------------------------------------------------
		 * Deductions
		 * -------------------------------------------------- */
        $deductions = $letOnlyScore + $numOnlyScore + $repScore + $consLowerScore + $consUpperScore + $consNumScore + $seqLetScore + $seqNumScore + $seqKeysScore + $phoneDeduction + $dateDeduction;
		/* --------------------------------------------------
		 * Final Score
		 * -------------------------------------------------- */
        $score = $additions - $deductions;
		$score = ($score < 0? 0 : ($score > 100? 100 : $score));
		if (($seqCap > 0) && ($score > $seqCap)) {
			$seqDeduction = $score - $seqCap;
			$deductions += $seqDeduction;
			$score -= $seqDeduction;
			$seqCount = $seqNumCount + $seqLetCount;
			$seqStrength = $this->scoreStrength($seqDeduction, 'sub');
			$seqCode = -1;
			$tests[] = ['Test' => 'Excessive Sequential Characters', 'Category' => 'Deductions', 'Count' => $seqCount, 'Score' => $seqDeduction, 'Strength' => $seqStrength, 'Code' => $seqCode, 'Msg' => $this->passCodeMsg($seqCode)];
		}
        if ($isBlacklisted && ($score > 15)) {
			$leetDeduction = $score - 15;
			$deductions += $leetDeduction;
			$score -= $leetDeduction;
			$leetStrength = $this->scoreStrength($leetDeduction, 'sub');
			$leetCode = -1;
			$tests[] = ['Test' => 'Leet-Speak', 'Category' => 'Deductions', 'Count' => 1, 'Score' => $leetDeduction, 'Strength' => $leetStrength, 'Code' => $leetCode, 'Msg' => $this->passCodeMsg($leetCode)];
		}
		if (($hasEmail) && ($score > 15)) {
			$emailDeduction = $score - 15;
			$deductions += $emailDeduction;
			$score -= $emailDeduction;
			$emailStrength = $this->scoreStrength($emailDeduction, 'sub');
			$emailCode = -1;
			$tests[] = ['Test' => 'Email Address Included', 'Category' => 'Deductions', 'Count' => 1, 'Score' => $emailDeduction, 'Strength' => $emailStrength, 'Code' => $emailCode, 'Msg' => $this->passCodeMsg($emailCode)];
		}
        $strength = $this->scoreStrength($score, 'pct');
        $complex = match(true) {
            ($isBlacklisted)					=> 'Common / Vulnerable',
            (($lenReq === 0) && ($score <= 20))	=> 'Too Short',
			($score <= 20)						=> 'Very Weak',
            ($score <= 40)						=> 'Weak',
            ($score <= 60)						=> 'Good',
            ($score <= 80)						=> 'Strong',
            default								=> 'Very Strong'
        };
        $data['Additions'] = $additions;
        $data['Complexity'] = $complex;
        $data['Deductions'] = $deductions;
        $data['Entropy'] = $this->passEntropy($pw, true);
        $data['Length'] = $pwLength;
        $data['Password'] = $pw;
        $data['Score'] = $score;
        $data['Strength'] = $strength;
        $data['Tests'] = $tests;
        return $strength;
    }
    
    /* ----------------------------------------------------------------------
	 * Inspectors
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::algorithmExists()
	 * 
	 * @param string $algo - Algorithm to check
	 * @return bool true|false
	 * @access private
	 * ----------------------------------------------------------------------*/
    private function algorithmExists(string $algo): bool {
        return in_array($algo, $this->listAlgorithms(), true);
    }
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::passCheck()
	 * 
	 * @param string $pw - Password to check
	 * @return bool - Guaranteed characters passed
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function passCheck(string $pw = ''): bool {
		if (!preg_match(self::LETTERSREGEX, $pw)) return false;
		if (($this->getConfig('uppercase') === true) && !preg_match(self::UPPERCASEREGEX, $pw)) return false;
		if (($this->getConfig('numbers') === true) && !preg_match(self::NUMBERSREGEX, $pw)) return false;
		if (($this->getConfig('symbols') === true) && !preg_match(self::SYMBOLSREGEX, $pw)) return false;
		return true;
	}
    
    /* ----------------------------------------------------------------------
	 * Helpers
	 * ----------------------------------------------------------------------*/
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::errorHash()
	 * 
	 * @return string - Randomized 'error_' hex string
	 * @access protected
	 * ----------------------------------------------------------------------*/
    protected function errorHash(): string {
        return 'error_' . bin2hex(random_bytes(28));
    }
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::getSymbols()
	 * 
	 * @return string - Symbols list
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function getSymbols(): string {
		$symbols = self::SYMBOLSAFELIST;
		$exclude = $this->getConfig('exclusion');
		if (!empty($exclude)) {
			$exclusions = str_split($exclude);
			$symbols = str_replace($exclusions, '', $symbols);
		}
		return $symbols;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::passCodeMsg()
	 * 
	 * @param int $code - Message code
	 * @return string - Message
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function passCodeMsg(int $code): string {
		return match(true) {
            $code === -2    => 'N/A',
			$code === -1	=> 'Fail',
			$code === 0		=> 'Warning',
			$code === 1		=> 'Good',
			$code === 2		=> 'Great',
			$code === 3		=> 'Pass',
			default			=> 'Undefined'
		};
	}
    
    /* ----------------------------------------------------------------------
	 * CoreyPHP::scoreStrength()
	 * 
	 * @param int $score - Score to format
	 * @param string $type - Format type
	 * @return string - Formatted score
	 * @access private
	 * ----------------------------------------------------------------------*/
    private function scoreStrength(int $score, string $type = 'add'): string {
        $strength = (string) match($type) {
            'add'   => ($score > 0? '+' . $score : 0),
            'sub'   => ($score > 0? '-' . $score : 0),
            'pct'   => ($score > 0? $score . '%' : 0 . '%'),
            default => $score
        };
        return $strength;
    }
	
	/* ----------------------------------------------------------------------
	 * CoreyPHP::validatePool()
	 * 
	 * @param string $pool - Password character pool
	 * @return bool - Fallback to exceptions.
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function validatePool(string $pool = ''): bool {
		if (!preg_match(self::LETTERSREGEX, $pool)) {
			$this->error('Lowercase letters are required by the password generator!', 'error');
			return false;
		}
		if (($this->getConfig('uppercase') === true) && !preg_match(self::UPPERCASEREGEX, $pool)) {
			$this->error('Exclusion of all uppercase letters is prohibited!', 'error');
			return false;
		}
		if (($this->getConfig('numbers') === true) && !preg_match(self::NUMBERSREGEX, $pool)) {
			$this->error('Exclusion of all numbers is prohibited!', 'error');
			return false;
		}
		if (($this->getConfig('symbols') === true) && !preg_match(self::SYMBOLSREGEX, $pool)) {
			$this->error('Exclusion of all symbols is prohibited!', 'error');
			return false;
		}
		return true;
	}

}

?>
