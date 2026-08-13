<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreyDB
 * @file		CoreyDB.php
 * ---------------------------------------------------------------------*/
declare(strict_types=1);

// TODO: Store phone number in format: E.164 (+17026015994) in varchar(20)

class CoreyDB extends CoreyPHP {
    
    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	public private(set) int $insertId = 0;
    
    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	private mysqli $db;
	private ?string $engine = null;
	private ?string $charset = null;
	private ?string $collation = null;
	private ?string $table = null;
	private array $databases = [];
	private array $tables = [];
	private array $columns = [];
	private ?string $command = null; // delete, insert, select, show, update (unused: alter, commit, create, drop, grant, revoke, rollback, savepoint, truncate)
	private ?string $keyword = null;
	private array $queryParts = [
		'bindings' => [],
		'filter' => [],
		'insert' => [],
		'join' => [], /* unused */
		'limit' => [],
		'order' => [],
		'query' => '',
		'replace' => [],
		'select' => [],
		'show' => '',
		'update' => [],
		'where' => []
	];
	private ?string $lastColumn = null;
	private ?string $lastQuery = null;
	private bool $orwhere = false;
	private string $output = 'auto';
    
    /* ----------------------------------------------------------------------
	 * Constants / Regular Expressions - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	protected const SQLDATE = 'Y-m-d';
	protected const SQLTIME = 'H:i:s';
	protected const SQLTIMESTAMP = 'Y-m-d H:i:s';
	protected const TAGREGEX = '/^\`?\[(\w+)\]\`?/i';
	
	/* ----------------------------------------------------------------------
	 * Core
	 * ----------------------------------------------------------------------*/

    /* ----------------------------------------------------------------------
	 * CoreyDB::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		$defaults = [
			'blacklist' => ['information_schema', 'mysql', 'performance_schema', 'phpmyadmin'],
			'charset' => 'utf8mb4',
			'collation' => 'utf8mb4_unicode_ci', /* hasnt been added yet */
			'db' => [
				'host' => 'localhost',
				'name' => '',
				'pass' => 'root',
				'user' => 'root'
			],
			'debug' => true,
			'engine' => 'InnoDB',
			'glue' => ' ',
			'output' => 'auto',
			'override' => false
		];
		$this->config = array_merge($defaults, $this->config);
		parent::__construct($userConfig);
		$this->output = $this->getValidOutput($this->config['output']);
		if ($this->getConfig('db.name')) $this->dbConnection();
	}
	
	/* ----------------------------------------------------------------------
	 * Environment
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::dbConnection()
	 * 
	 * @param string|null $dbname - Database name
	 * @param string|null $dbuser - Database username
	 * @param string|null $dbpass - Database password
	 * @param string|null $dbhost - Database hostname
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function dbConnection(?string $dbname = null, ?string $dbuser = null, ?string $dbpass = null, ?string $dbhost = null): static {
		if ($dbname !== null) $this->setConfig('db.name', $dbname);
		if ($dbuser !== null) $this->setConfig('db.user', $dbuser);
		if ($dbpass !== null) $this->setConfig('db.pass', $dbpass);
		if ($dbhost !== null) $this->setConfig('db.host', $dbhost);
		$dbname = $this->getConfig('db.name') ?? '';
		$dbuser = $this->getConfig('db.user') ?? '';
		$dbpass = $this->getConfig('db.pass') ?? '';
		$dbhost = $this->getConfig('db.host') ?? '';
		if (!$dbname) $this->error('No database has been specified!', 'error');
		if (!$dbuser) $this->error('No database username has been specified!', 'error');
		if (!$dbpass) $this->error('No database password has been specified!', 'error');
		if (!$dbhost) $this->error('No database host has been specified!', 'error');
		if (!isset($this->db) || !$this->db instanceof mysqli) {
			try {
				mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
				$dbconn = new mysqli($dbhost, $dbuser, $dbpass);
				// TODO: Needs check for charset type.
				$charset = $this->getConfig('charset');
				$dbconn->set_charset($charset);
				// TODO: Possibly add query (SET collation_connection = '$config['collation']')
				$this->db = $dbconn;
				$this->engine = $this->query('SELECT @@default_storage_engine as engine')->output('string')->execute();
				$this->charset = $this->query('SELECT @@character_set_server')->output('string')->execute();
				$this->collation = $this->query("SHOW VARIABLES LIKE 'collation_server'")->filter('Value')->output('string')->execute();
				$this->dbSelect($dbname);
			} catch (mysqli_sql_exception $e) {
				$this->error('Connection failed: ' . $e->getMessage(), 'error');
			}
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::dbSelect()
	 * 
	 * @param string $dbname - Database name
	 * @return bool true|false
	 * ----------------------------------------------------------------------*/
	public function dbSelect(string $dbname): bool {
		$this->checkConnection();
		if ($this->databaseExists($dbname) !== true) return false;
		$dbselect = $this->db->select_db($dbname);
		if ($dbselect === true) {
			$this->setConfig('db.name', $dbname);
		} else {
			$this->error('Could not select database: ' . $dbname, 'warning');
		}
		return $dbselect;
	}
	
	// TODO: charset (utf8mb4)
	// TODO: collation (utf8mb4_unicode_ci)
	// TODO: engine (InnoDB)
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::getDiagnostics()
	 * 
	 * @return array - Server, database, and table information
	 * ----------------------------------------------------------------------*/
	public function getDiagnostics(): array {
		$result = $this->query('SELECT @@character_set_database, @@collation_database')->output('array')->execute();
		$diagnostics = [
			'server' => [
				'version' => $this->getServerVersion(),
				'protocol' => $this->getProtocolVersion(),
				'host_info' => $this->getHostInfo(),
				'engine' => $this->engine,
				'charset' => $this->charset,
				'collation' => $this->collation,
				'databases' => null
			],
			'database' => [
				'name' => $this->getConfig('db.name'),
				'charset' => $result[0],
				'collation' => $result[1],
				'tables' => null
			],
			'table' => null
		];
		if ($this->table !== null) {
			$result = $this->query("SHOW TABLE STATUS LIKE '$this->table'")->filter('Engine', 'Collation')->output('assoc')->execute();
			$diagnostics['table'] = [
				'name' => $this->table,
				'engine' => $result['Engine'],
				'collation' => $result['Collation'],
				'columns' => null
			];
			if (!empty($this->columns)) {
				$diagnostics['table']['columns'] = $this->columns;
			}
		}
		if (!empty($this->databases)) {
			$diagnostics['server']['databases'] = $this->databases;
		}
		if (!empty($this->tables)) {
			$diagnostics['database']['tables'] = $this->tables;
		}
		return $diagnostics;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::getHostInfo()
	 * 
	 * @return string - Host Info
	 * ----------------------------------------------------------------------*/
	public function getHostInfo(): string {
		return $this->db->host_info;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::getProtocolVersion()
	 * 
	 * @return int - Protocol version
	 * ----------------------------------------------------------------------*/
	public function getProtocolVersion(): int {
		return $this->db->protocol_version;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::getServerVersion()
	 * 
	 * @return string - Server version
	 * ----------------------------------------------------------------------*/
	public function getServerVersion(): string {
		return $this->db->server_info;
	}
	
	/* ----------------------------------------------------------------------
	 * Inspectors
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::checkConnection()
	 * 
	 * @return bool true|false
	 * @access private
	 * ----------------------------------------------------------------------*/
	private function checkConnection(): bool {
		if (!isset($this->db) || !($this->db instanceof mysqli)) return $this->error('No database connection has been established!', 'error');
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::databaseExists()
	 * 
	 * @return bool true|false
	 * @access private
	 * ----------------------------------------------------------------------*/
	private function databaseExists(string $dbname): bool {
		$databases = $this->listDatabases();
		if (empty($databases)) return false;
		if (!in_array($dbname, $databases)) return $this->error('The database `' . $dbname . '` does not exist or is blacklisted!', 'error');
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::tableExists()
	 * 
	 * @return bool true|false
	 * @access private
	 * ----------------------------------------------------------------------*/
	private function tableExists(string $table): bool {
		$tables = $this->listTables();
		if (empty($tables)) return false;
		if (!in_array($table, $tables)) return $this->error('The table `' . $table . '` does not exist!', 'notice');
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::columnExists()
	 * 
	 * @return bool true|false
	 * @access private
	 * ----------------------------------------------------------------------*/
	private function columnExists(string $column): bool {
		$columns = $this->listColumns();
		if (empty($columns)) return false;
		if (!in_array($column, $columns)) return $this->error('The column `' . $column . '` does not exist!', 'notice');
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * Structure
	 * ----------------------------------------------------------------------*/
	
	// TODO: keys - getKeys(), getIndexes()
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::getLastQuery()
	 * 
	 * @return string|null
	 * ----------------------------------------------------------------------*/
	// TODO: Create an option for storing queries in the database.
	public function getLastQuery(): ?string {
		return $this->lastQuery ?? null;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::getTable()
	 * 
	 * @return string|null
	 * ----------------------------------------------------------------------*/
	public function getTable(): ?string {
		return $this->table ?? null;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::setTable()
	 * 
	 * @param string $table - Table name
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function setTable(string $table): static {
		$this->checkConnection();
		$table = trim($table);
		$this->tableExists($table);
		$this->table = $table;
		$this->listColumns(true);
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::listColumns()
	 * 
	 * @param bool $refresh - Refresh the list
	 * @return array - Columns list from current table
	 * ----------------------------------------------------------------------*/
	public function listColumns(bool $refresh = false): array {
		if ($this->table === null) {
			$this->error('No table has been defined to list columns from!', 'notice');
			return [];
		} else {
			if (empty($this->columns) || ($refresh === true)) $this->columns = $this->show('columns')->filter('Field')->output('array')->execute();
		}
		return $this->columns;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::listDatabases()
	 * 
	 * @param bool $refresh - Refresh the list
	 * @return array - Database list
	 * ----------------------------------------------------------------------*/
	// TODO: Add output feature.
	public function listDatabases(bool $refresh = false): array {
		if (empty($this->databases) || ($refresh === true)) $this->databases = $this->show('databases')->where('Database')->notIn($this->config['blacklist'])->output('array')->execute();
		return $this->databases;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::listTables()
	 * 
	 * @param bool $refresh - Refresh the list
	 * @return array - Table list
	 * ----------------------------------------------------------------------*/
	public function listTables(bool $refresh = false): array {
		if ($this->getConfig('db.name') === '') {
			$this->error('No database has been defined to list tables from!', 'notice');
			return [];
		} else {
			if (empty($this->tables) || ($refresh === true)) $this->tables = $this->show('tables')->output('array')->execute();
		}
		return $this->tables;
	}
	
	/* ----------------------------------------------------------------------
	 * Modifiers
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::between()
	 * 
	 * @param string|int|float $min - Minimum value
	 * @param string|int|float|null $max - Maximum value
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Add the override option to override modifications.
	public function between(string|int|float $min, string|int|float|null $max = null): static {
		if ($this->lastColumn !== null) {
			array_pop($this->queryParts['where']);
			if ($max === null) {
				$this->error('Parameter missing from between() method! Query modified.');
				if (is_string($min)) {
					return $this->where($this->lastColumn, $min);
				}
				$max = ($min < 0? 0 : $min);
				$min = ($min < 0? $min : 0);
			}
			$this->queryParts['where'][] = $this->sqlWrap($this->lastColumn) . ' BETWEEN ? AND ?';
			$this->queryParts['bindings']['where'][] = $min;
			$this->queryParts['bindings']['where'][] = $max;
			return $this;
		}
		$this->error('Between() method was ignored!');
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::filter()
	 * 
	 * @param array|string $filters - List of column filters
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: See if filters can be validated as valid columns.
	public function filter(array|string ...$filters): static {
		$filters = (isset($filters[0]) && is_array($filters[0]) ? $filters[0] : $filters);
		$this->queryParts['filter'] = $filters;
		return $this;
	}
	
	// TODO: group
	// TODO: having?
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::in()
	 * 
	 * @param array|string|int|float $args - List of In values
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function in(array|string|int|float ...$args): static {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if ($this->lastColumn !== null) {
			array_pop($this->queryParts['where']);
			$count = count($args);
			if ($count == 1) {
				$this->error('In() method does not contain enough values. Query modified!');
				return $this->where($this->lastColumn, $args[0]);
			}
			$this->queryParts['where'][] = $this->sqlWrap($this->lastColumn) . ' IN (' . implode(', ', array_fill(0, $count, '?')) . ')';
			foreach ($args as $arg) {
				$this->queryParts['bindings']['where'][] = $arg;
			}
			return $this;
		}
		$this->error('In() method was ignored!');
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::notIn()
	 * 
	 * @param array|string|int|float $args - List of Not In values
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function notIn(array|string|int|float ...$args): static {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		if ($this->lastColumn !== null) {
			array_pop($this->queryParts['where']);
			$count = count($args);
			if ($count == 1) {
				$this->error('NotIn() method does not contain enough values. Query modified!');
				return $this->where($this->lastColumn, $args[0], '<>');
			}
			$this->queryParts['where'][] = $this->sqlWrap($this->lastColumn) . ' NOT IN (' . implode(', ', array_fill(0, $count, '?')) . ')';
			foreach ($args as $arg) {
				$this->queryParts['bindings']['where'][] = $arg;
			}
			return $this;
		}
		$this->error('NotIn() method was ignored!');
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::like()
	 * 
	 * @param string $term - Search term
	 * @param string $op - Search operator
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Add something that protects if % is in the term.
	// TODO: Make it so multiple like methods can be chained.
	public function like(string $term, string $op = '%') {
		if ($this->lastColumn !== null) {
			array_pop($this->queryParts['where']);
			$this->queryParts['where'][] = $this->sqlWrap($this->lastColumn) . ' LIKE ?';
			$this->queryParts['bindings']['where'][] = $this->searchStr($term, $op);
			return $this;
		}
		$this->error('Like() method was ignored!');
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::limit()
	 * 
	 * @param int $limit - Limit value
	 * @param int $offset - Offset of limit
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function limit(int $limit = 0, int $offset = 0): static {
		if ($limit > 0) {
			$this->queryParts['limit'][0] = $limit;
			if ($offset > 0) $this->queryParts['limit'][1] = $offset;
		} else {
			$this->error('Limit must be a positive integer!', 'notice');
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::offset()
	 * 
	 * @param int $offset - Offset of limit
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function offset(int $offset = 0): static {
		if ($offset > 0) {
			$this->queryParts['limit'][1] = $offset;
		} else {
			$this->error('Offset must be a positive integer!', 'notice');
		}
		return $this;
	}
	
	// TODO: modify
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::order()
	 * 
	 * @param array|string $columns - List of Order By columns
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Validate columns
	public function order(array|string ...$columns): static {
		$columns = (isset($columns[0]) && is_array($columns[0]) ? $columns[0] : $columns);
		foreach ($columns as $column) {
			$this->queryParts['order'][$column] = $this->sqlWrap($column);
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::orderByValue()
	 * 
	 * @param string $columns - Order By column
	 * @param mixed $value - Order By value
	 * @param bool $desc - Descending order
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Validate columns
	public function orderByValue(string $column, mixed $value = null, bool $desc = true) {
		if ($value === null) {
			$this->queryParts['order'][] = '(' . $this->sqlWrap($column) . ' IS NULL) ' . ($desc === false? 'ASC' : 'DESC');
		} else {
			$this->queryParts['order'][] = '(' . $this->sqlWrap($column) . ' = ?) ' . ($desc === false? 'ASC' : 'DESC');
			$this->queryParts['bindings']['order'][] = $value;
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::order()
	 * 
	 * @param array|string $columns - List of columns for ascending order
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Validate columns
	public function asc(array|string ...$columns): static {
		$columns = (isset($columns[0]) && is_array($columns[0]) ? $columns[0] : $columns);
		foreach ($columns as $column) {
			$this->queryParts['order'][$column] = $this->sqlWrap($column) . ' ASC';
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::order()
	 * 
	 * @param array|string $columns - List of columns for descending order
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Validate columns
	public function desc(array|string ...$columns): static {
		$columns = (isset($columns[0]) && is_array($columns[0]) ? $columns[0] : $columns);
		foreach ($columns as $column) {
			$this->queryParts['order'][$column] = $this->sqlWrap($column) . ' DESC';
		}
		return $this;
	}
	
	// TODO: rowCount
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::where()
	 * 
	 * @param string|null $column - Column name
	 * @param mixed $value - Column value
	 * @param string $op - Comparison operator
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function where(?string $column = null, mixed $value = null, string $op = '='): static {
		$this->lastColumn = null;
		if ($column === null) {
			$this->queryParts['where'][] = 1;
			return $this;
		}
		if ($value === null) {
			$this->lastColumn = $column;
		} else if (is_array($value)) {
			$this->orwhere = true;
			foreach ($value as $arg) {
				$this->queryParts['where'][] = $this->whereStr($column, $arg, $op);
			}
		} else {
			$this->queryParts['where'][] = $this->whereStr($column, $value, $op);
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::andWhere()
	 * 
	 * @param array $array - Where array
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Add array option to allow multiple values with same column and operator like in where.
	public function andWhere(array $array = []): static {
		if (empty($array)) $this->error('The where array is empty!', 'warning');
		if (!empty($this->queryParts['where']) && ($this->orwhere === true)) $this->error('You have already started the where clause with the logical OR operator!', 'error');
		$this->orwhere = false;
		$array = $this->normalizeWhere($array);
		foreach ($array as $arg) {
			if (isset($arg[0]) && is_array($arg[0])) {
				$this->whereGroup($arg);
			} else {
				$this->where($arg['column'], $arg['value'], $arg['op']);
			}
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::orWhere()
	 * 
	 * @param array $array - Where array
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Make it so orWhere works like where if an array isn't defined but a string.
	public function orWhere(array $array = []): static {
		if (empty($array)) $this->error('The where array is empty!', 'warning');
		if (!empty($this->queryParts['where']) && ($this->orwhere === false)) $this->error('You have already started the where clause with the logical AND operator!', 'error');
		$this->orwhere = true;
		$array = $this->normalizeWhere($array);
		foreach ($array as $arg) {
			if (isset($arg[0]) && is_array($arg[0])) {
				$this->whereGroup($arg);
			} else {
				$this->where($arg['column'], $arg['value'], $arg['op']);
			}
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * Operations
	 * ----------------------------------------------------------------------*/
	
	// TODO: alter
	// TODO: create
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::delete()
	 * 
	 * @param string|null $column - Column name
	 * @param mixed $value - Column value
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Add safety feature to prevent from deleting all data.
	// TODO: Use override to allow someone to delete all records.
	public function delete(?string $column = null, mixed $value = null): static {
		$this->command = 'delete';
		if (($column === null) !== ($value === null)) $this->error('Both delete() arguments must have a value or use where() method instead!', 'warning');
		if (($column !== null) && ($value !== null)) $this->where($column, $value);
		return $this;
	}
	
	// TODO: describe
	// TODO: drop
	// TODO: explain
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::insert()
	 * 
	 * @param array|string $args - List of columns to update
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Throw exception if columns and values don't match.
	// TODO: Make sure values() can't be called twice.
	// TODO: Add multiple rows method using values().
	public function insert(array|string ...$args): static {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		$this->command = 'insert';
		if ($this->isAssoc($args)) {
			$keys = array_keys($args);
			$values = array_values($args);
			$keys = array_map(array($this, 'sqlWrap'), $keys);
			$this->queryParts['insert'] = $keys;
			$this->values($values);
		} else {
			$args = array_map(array($this, 'sqlWrap'), $args);
			$this->queryParts['insert'] = $args;
		}
		return $this;
	}
	
	// TODO: insertID
	// TODO: join
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::query()
	 * 
	 * @param string $query - SQL query
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: See if bindings can be added.
	public function query(string $sql): static {
		$this->resetState();
		$this->command = 'query';
		$this->queryParts['query'] = $sql;
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::replace()
	 * 
	 * @param array|string $args - List of columns to update
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: replace: use standard values method for multiple rows, otherwise set method for inividual row.
	public function replace(array|string ...$args): static {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		$this->command = 'replace';
		if ($this->isAssoc($args)) {
			$keys = array_keys($args);
			$values = array_values($args);
			$keys = array_map(function($arg) {
				return $this->sqlWrap($arg) . ' = ?';
			}, $keys);
			$this->queryParts['replace'] = $keys;
			$this->values($values);
		} else {
			$args = array_map(function($arg) {
				return $this->sqlWrap($arg) . ' = ?';
			}, $args);
			$this->queryParts['replace'] = $args;
		}
		return $this;
	}
	
	// TODO: rollup
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::select()
	 * 
	 * @param array|string $args - List of columns to select
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Add parse to select. (ex. SELECT SUM(qty))
	// TODO: Add former funcParse function.
	public function select(array|string ...$columns): static {
		$columns = (isset($columns[0]) && is_array($columns[0]) ? $columns[0] : $columns);
		$this->command = 'select';
		if (empty($columns)) {
			$args = ['*'];
		}else {
			$args = [];
			foreach ($columns as $key => $fallback) {
				if (is_string($key)) {
					$column = $this->sqlWrap($key, 'key');
					$this->queryParts['bindings']['select'][] = $fallback;
					$args[] = 'COALESCE(' . $column . ', ?) AS ' . $column;
				} else {
					$args[] = $this->sqlWrap($fallback, 'key');
				}
			}
		}
		$this->queryParts['select'] = $args;
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::select()
	 * 
	 * @param string $column - Column to select
	 * @param string $as - Rename as
	 * @param string $concat - Columns and strings to concat with $column
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function selectAs(string $column, string $as, string ...$concat): static {
		$this->command = 'select';
		if (!empty($concat)) {
			$concat = array_merge([$column], $concat);
			$concat = array_map(function(string $arg): string {
				if ($this->columnExists($arg)) return $this->sqlWrap($arg);
				return $this->sqlWrap($arg, 'var');
			}, $concat);
			$glue = $this->getConfig('glue');
			if (empty($glue) || ($glue === '')) {
				$this->queryParts['select'][] = 'CONCAT(' . implode(', ', $concat) . ') AS ' . $this->sqlWrap($as);
			} else {
				$this->queryParts['select'][] = 'CONCAT_WS(' . $this->sqlWrap($glue) . ', ' . implode(', ', $concat) . ') AS ' . $this->sqlWrap($as);
			}
		} else {
			$this->queryParts['select'][] = $this->sqlWrap($column) . ' AS ' . $this->sqlWrap($as);
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::show()
	 * 
	 * @param string $keyword - Keyword that matches show statement
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Add rest of sql statements.
	public function show(string $keyword = 'tables'): static {
		$this->resetState();
		$this->command = 'show';
		$this->keyword = $keyword;
		$arg = match($keyword) {
			'charset', 'character set'			=> 'CHARACTER SET',
			'collation', 'collation set'		=> 'COLLATION',
			'column', 'columns'					=> 'COLUMNS FROM ' . $this->sqlWrap($this->table),
			'database', 'databases', 'schemas'	=> 'DATABASES',
			'engine'							=> 'ENGINE ' . $this->sqlWrap($this->engine) . ' STATUS',
			'engines'							=> 'ENGINES',
			'index', 'indexes'					=> 'INDEX FROM ' . $this->sqlWrap($this->table),
			'key', 'keys'						=> 'KEYS FROM ' . $this->sqlWrap($this->table),
			'open tables'						=> 'OPEN TABLES',
			'plugin', 'plugins'					=> 'PLUGINS',
			'privilege', 'privileges'			=> 'PRIVILEGES',
			'processlist'						=> 'PROCESSLIST',
			'status'							=> 'STATUS',
			'table status'						=> 'TABLE STATUS',
			'table', 'tables'					=> 'TABLES',
			'variable', 'variables'				=> 'VARIABLES',
			default								=> $this->error('Invalid SHOW keyword!', 'warning')
		};
		$this->queryParts['show'] = $arg;
		return $this;
	}
	
	// TODO: truncate
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::update()
	 * 
	 * @param array|string $args - List of columns to update
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Make sure values() can't be called twice.
	// TODO: Add multiple rows method using values().
	// TODO: Figure out UPDATE...SET salary = salary * 1.10, example
	public function update(array|string ...$args): static {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		$this->command = 'update';
		if ($this->isAssoc($args)) {
			$keys = array_keys($args);
			$values = array_values($args);
			$keys = array_map(function($arg) {
				return $this->sqlWrap($arg) . ' = ?';
			}, $keys);
			$this->queryParts['update'] = $keys;
			$this->values($values);
		} else {
			$args = array_map(function($arg) {
				return $this->sqlWrap($arg) . ' = ?';
			}, $args);
			$this->queryParts['update'] = $args;
		}
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::values()
	 * 
	 * @param mixed $args - List of values for insert and update
	 * @return $this
	 * ----------------------------------------------------------------------*/
	// TODO: Validate that keys and values are the same amount.
	public function values(mixed ...$args): static {
		$args = (isset($args[0]) && is_array($args[0]) ? $args[0] : $args);
		$bindings = array_map(array($this, 'parseTag'), $args);
		$this->queryParts['bindings'][$this->command] = $bindings;
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * Execution
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::execute()
	 * 
	 * @return mixed - Output data
	 * ----------------------------------------------------------------------*/
	// TODO: Change table check to method like checkConnection
	// TODO: For the query method, create an output = stream for MYSQLI_USE_RESULT option.
	// TODO: Can prepare accept null?
	// TODO: When filters are added, use array_column to create [id] => 'user'
	public function execute(): mixed {
		$command = trim($this->command);
		if (!$this->table && ($command !== 'query') && ($command !== 'show')) $this->error('No table has been defined!', 'error');
		/* Query & Bindings */
		$sql = $this->compile();
		if (empty(trim($sql))) $this->error('Framework Error: Compiled SQL string is empty!', 'error');
		$bindings = array_merge(
			$this->queryParts['bindings']['query'] ?? [],
			$this->queryParts['bindings']['select'] ?? [],
			$this->queryParts['bindings']['insert'] ?? [],
			$this->queryParts['bindings']['replace'] ?? [],
			$this->queryParts['bindings']['update'] ?? [],
			$this->queryParts['bindings']['where'] ?? [],
			$this->queryParts['bindings']['order'] ?? []
		);
		if (empty($bindings)) {
			$result = $this->db->query($sql);
			if ($this->db->error) $this->error('MySQLi Error: ' . $this->db->error . '; Query: ' . $sql, 'error');
			if (is_bool($result)) {
				$data = $result;
			} else {
				$data = $result->fetch_all(MYSQLI_ASSOC) ?: [];
				$result->free();
				$data = $this->formatData($data);
			}
			$this->resetState();
			return $data;
		}
		$stmt = $this->db->prepare($sql);
		$types = $this->bindings($bindings);
		$bind = $stmt->bind_param($types, ...$bindings);
		if ($bind === false) $this->error('There was an issue binding the values!', 'error');
		/* Execute & Data */
		$data = false;
		$output = $this->output;
		if ($stmt->execute() !== false) {
			switch ($command) {
				case 'delete': case 'update':
					$data = $stmt->affected_rows;
				break;
				case 'insert':
					$data = $stmt->insert_id ?: true;
					if (is_int($data) && ($data > 0)) $this->insertId = $data;
				break;
				case 'replace':
					$insertId = $stmt->insert_id;
					$data = $stmt->affected_rows;
					if (is_int($insertId) && ($insertId > 0)) $this->insertId = $insertId;
				break;
				default:
					$result = $stmt->get_result();
					if ($result instanceof \mysqli_result) {
						$data = $result->fetch_all(MYSQLI_ASSOC) ?: [];
						$result->free();
						$data = $this->formatData($data);
					} else {
						$data = $stmt->affected_rows >= 0 ? $stmt->affected_rows : true;
					}
				break;
			}
			$stmt->close();
		} else {
			$this->error('There was an issue executing the query!', 'error');
		}
		/* Reset */
		$this->resetState();
		/* Return */
		return $data;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::execute()
	 * 
	 * @param string $sql - Sql code to execute
	 * @return mixed - Output data
	 * ----------------------------------------------------------------------*/
	// TODO: Maybe add a way to get single values returned as a string.
	public function executeRaw(string $sql): mixed {
		$result = $this->db->query($sql);
		if ($this->db->error) $this->error('MySQLi Error: ' . $this->db->error . '; Query: ' . $sql, 'error');
		if (is_bool($result)) return $result;
		$data = $result->fetch_all(MYSQLI_ASSOC);
		$result->free();
		return $data;
	}
	
	// TODO: maintenance
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::preview()
	 * 
	 * @return string - Preview sql command
	 * ----------------------------------------------------------------------*/
	// TODO: Add an option to preview as HTML so user doesn't have to echo out sql.
	// TODO: Add feature so preview can show bindings.
	public function preview(): string {
		$tempTable = false;
		if (!$this->table) {
			$this->error('No table has been defined!');
			$this->table = 'UNDEFINED';
			$tempTable = true;
		}
		$sql = $this->compile();
		if ($tempTable === true) $this->table = null;
		$this->resetState();
		return $sql;
	}
	
	// TODO: test
	
	/* ----------------------------------------------------------------------
	 * Compilers
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::compile()
	 * 
	 * @return string - SQL statement
	 * @access protected
	 * ----------------------------------------------------------------------*/
	// TODO: insert - insert into, table, (columns), values, (placeholders?); optional select, same order; on duplicate key update [Use bind_param]
	// TODO: join - join type (ex. left, right, inner), join, table, on, first column, operator, second column
	// TODO: select - select, from(table), join, where, group by, having, order by, limit, offset [Use bind_param]
	// TODO: replace - just like insert
	// TODO: Add more to show statements including where.
	protected function compile(): string {
		$sql = '';
		switch($this->command) {
			case 'delete':
				if (empty($this->queryParts['where'])) $this->error('Delete statement requires where clause!', 'error');
				$sql .= 'DELETE FROM ' . $this->sqlWrap($this->table);
				$sql .= $this->compileWhere();
				$sql .= $this->compileOrder();
				$sql .= $this->compileLimit();
			break;
			case 'insert':
				$count = count($this->queryParts['insert']);
				$sql .= 'INSERT INTO ' . $this->sqlWrap($this->table) . ' (' . implode(', ', $this->queryParts['insert']) . ') VALUES (' . implode(', ', array_fill(0, $count, '?')) . ')';
			break;
			case 'query':
				$sql .= $this->queryParts['query'];
			break;
			case 'replace':
				$sql .= 'REPLACE INTO ' . $this->sqlWrap($this->table) . ' SET ' . implode(', ', $this->queryParts['replace']);
			break;
			case 'select':
				$sql .= 'SELECT ' . implode(', ', $this->queryParts['select']) . ' FROM ' . $this->sqlWrap($this->table);
				$sql .= $this->compileWhere();
				$sql .= $this->compileOrder();
				$sql .= $this->compileLimit();
			break;
			case 'show':
				$sql .= 'SHOW ' . $this->queryParts['show'];
				$sql .= match ($this->keyword) {
					'charset', 'character set', 'collation', 'collation set', 'column', 'columns', 'database', 'databases', 'index', 'indexes', 'key', 'keys', 'open tables', 'schemas', 'status', 'table status', 'table', 'tables', 'variable', 'variables' => $this->compileWhere(),
					default	=> ''
				};
			break;
			case 'update':
				if (empty($this->queryParts['where'])) $this->error('Update statement requires where clause!', 'error');
				$sql .= 'UPDATE ' . $this->sqlWrap($this->table) . ' SET ' . implode(', ', $this->queryParts['update']);
				$sql .= $this->compileWhere();
				$sql .= $this->compileOrder();
				$sql .= $this->compileLimit();
			break;
			default:
				$this->error('No query operation has been selected!', 'warning');
				$sql = null;
			break;
		}
		return $this->lastQuery = trim($sql);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::compileLimit()
	 * 
	 * @return string - Limit query
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function compileLimit(): string {
		$sql = '';
		if (!empty($this->queryParts['limit'])) {
			if (empty($this->queryParts['order'])) $this->error('Cannot compile LIMIT modifier without an explicit ORDER BY clause. Please ensure order() is added to the query.', 'error');
			if (isset($this->queryParts['limit'][0])) {
				$sql .= ' LIMIT ' . $this->queryParts['limit'][0];
				if (isset($this->queryParts['limit'][1])) {
					if ($this->command === 'select') {
						$sql .= ' OFFSET ' . $this->queryParts['limit'][1];
					} else {
						$this->error(strtoupper($this->command) . ' statements do not use offsets!', 'warning');
					}
				}
			} else {
				$this->error('The query cannot include an offset without a defined limit!', 'notice');
			}
		}
		return $sql;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::compileOrder()
	 * 
	 * @return string - Where query
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function compileOrder(): string {
		$sql = '';
		$priorityOrders = [];
		$standardOrders = [];
		if (!empty($this->queryParts['order'])) {
			foreach ($this->queryParts['order'] as $key => $value) {
				if (is_int($key)) {
					$priorityOrders[] = $value;
				} else {
					$standardOrders[] = $value;
				}
			}
			$finalOrders = array_merge($priorityOrders, $standardOrders);
			$sql .= ' ORDER BY ';
			$sql .= implode(', ', $finalOrders);
		}
		return $sql;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::compileWhere()
	 * 
	 * @return string - Where query
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function compileWhere(): string {
		$sql = '';
		if (!empty($this->queryParts['where'])) {
			$sql .= ' WHERE ';
			$connector = ($this->orwhere === true? ' OR ' : ' AND ');
			$sql .= implode($connector, $this->queryParts['where']);
		}
		return $sql;
	}
	
	/* ----------------------------------------------------------------------
	 * Output
	 * ----------------------------------------------------------------------*/
	
	// TODO: fetchAssoc
	// TODO: fetchObject
	// TODO: fetchRow
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::output()
	 * 
	 * @param string $output - Output type
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function output(string $output = 'auto'): static {
		$isValid = false;
		$this->output = $this->getValidOutput($output, $isValid);
		if (!$isValid) $this->error('Invalid output data type! (' . $output . ')', 'notice');
		return $this;
	}
	
	// TODO: printOutput
	
	/* ----------------------------------------------------------------------
	 * Utilities
	 * ----------------------------------------------------------------------*/
	
	// TODO: funcParse
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::parseTag()
	 * 
	 * @param string $tag - Tag to parse
	 * @return string|int - Parsed tag
	 * ----------------------------------------------------------------------*/
	// TODO: Add [ip].
	// TODO: Add something like [user_id].
	// TODO: Add something like [session_id].
	// TODO: Add [uuid].
	// TODO: Add [token] using bin2hex(random_bytes(16)).
	// TODO: Add [user_agent] using $_SERVER['HTTP_USER_AGENT'].
	public function parseTag(string $tag): string|int {
		if (preg_match(self::TAGREGEX, $tag, $match)) {
			switch ($match[1]) {
				case 'date': $tag = date(self::SQLDATE); break;
				case 'datetime': $tag = date(self::SQLTIMESTAMP); break;
				case 'time': $tag = date(self::SQLTIME); break;
				case 'timestamp': $tag = time(); break;
				default: $this->error('Invalid tag! (' . $match[0] . ')', 'warning'); break;
			}
		}
		return $tag;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::sqlEscape()
	 * 
	 * @param mixed $esc - Variable to escape
	 * @param bool $search - Is search term
	 * @return string - The escaped variable
	 * ----------------------------------------------------------------------*/
	public function sqlEscape(mixed $esc = null, bool $search = false): string {
		if ($esc === null) return 'NULL';
		if (is_numeric($esc)) return (string) $esc;
		$esc = $this->db->real_escape_string($esc);
		$type = ($search === true) ? 'search' : 'var';
		return $this->sqlWrap($esc, $type);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::sqlWrap()
	 * 
	 * @param string $wrap - Variable to wrap
	 * @param string $type - The wrap type (key, search, var)
	 * @param bool $startsWith - Type search start flag
	 * @param bool $endsWith - Type search end flag
	 * @return string - The wrapped variable
	 * ----------------------------------------------------------------------*/
	public function sqlWrap(?string $wrap = null, string $type = 'key', string $op = '%'): ?string {
		if (!$wrap) return null;
		if ($wrap == '*') return $wrap;
		if (($wrap !== '') && (trim($wrap) === '')) {
			$wrap = ' ';
			$type = 'var';
		}
		if ($type == 'search') {
			$term = $this->searchStr($wrap, $op);
			return "'$term'";
		}
		return (($type == 'var') || ($type == 'variable')) ? "'$wrap'" : "`$wrap`";
	}
	
	/* ----------------------------------------------------------------------
	 * Validation
	 * ----------------------------------------------------------------------*/
	
	// TODO: isSameType
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::isValidOperator()
	 * 
	 * @param string $operator - Operator to validate
	 * @return bool - True on success
	 * ----------------------------------------------------------------------*/
	public function isValidOperator(?string $operator = null): bool {
		if ($operator === null) return false;
		$allowedOperators = ['=', '==', '!=', '<>', '<', '>', '<=', '>=', '<=>', '%', '%=', '=%'];
		return in_array($operator, $allowedOperators, true);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::isValidOutput()
	 * 
	 * @param string $output - Output type to validate
	 * @return bool - True on success
	 * ----------------------------------------------------------------------*/
	// TODO: Add bool, xml, csv, yaml
	public function isValidOutput(?string $output = null): bool {
		if ($output === null) return false;
		$allowedOutputs = ['array', 'assoc', 'auto', 'integer', 'int', 'json', 'object', 'obj', 'serial', 'string', 'str'];
		return in_array($output, $allowedOutputs, true);
	}
	
	/* ----------------------------------------------------------------------
	 * Helpers
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::bindings()
	 * 
	 * @param array $items - List of values to create bindings string from
	 * @return string - Types for bindings
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function bindings(array $items): string {
		$types = '';
		foreach ($items as $item) {
			$types .= match(true) {
				is_int($item), is_bool($item)	=> 'i',
				is_float($item)					=> 'd',
				is_resource($item)				=> 'b',
				default							=> 's'
			};
		}
		return $types;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::formatData()
	 * 
	 * @param mixed $data - Query data to format
	 * @return mixed - Formatted data
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function formatData(mixed $data): mixed {
		$output = $this->output;
		if (!empty($data)) {
			/* Filter */
			if (!empty($this->queryParts['filter'])) {
				$filters = $this->queryParts['filter'];
				$filtered = [];
				foreach ($data as $row) {
					$filtered[] = array_intersect_key($row, array_flip($filters));
				}
				$data = $filtered;
			}
			/* Output */
			if (($output === 'integer') || ($output === 'string') || ($output === 'auto')) {
				if (count($data) === 1 && is_array($data[0]) && count($data[0]) === 1) $data = reset($data[0]);
				if (is_array($data) && count($data) === 1) $data = $data[0];
			}
			if (($output !== 'integer') && ($output !== 'string') && is_array($data)) {
				if (count($data) === 1) $data = $data[0];
			}
			if (($output === 'array') || ($output === 'json') || ($output === 'serial') || ($output === 'auto')) {
				if (is_array($data) && !$this->isAssoc($data) && isset($data[0]) && is_array($data[0]) && (count($data[0]) === 1)) {
					$array = [];
					array_walk_recursive($data, function($value) use (&$array) {
						$array[] = $value;
					});
					$data = $array;
				}
				if ($output === 'array') $data = array_values($data);
			}
		} else {
			switch ($output) {
				case 'integer':
					$data = 0;
				break;
				case 'string':
					$data = '';
				break;
				case 'auto':
					$data = null;
				break;
				default:
					$data = [];
				break;
			}
		}
		/* Conversion */
		switch ($output) {
			case 'json': $data = $this->arrayToJson($data); break;
			case 'object': $data = $this->arrayToObject($data); break;
			case 'serial': $data = $this->arrayToSerial($data); break;
		}
		return $data;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::getValidOperator()
	 * 
	 * @param string $operator - Operator to check
	 * @param bool &$valid - Provided operator was valid (passed by reference)
	 * @return string - Valid operator
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function getValidOperator(?string $operator, bool &$valid = false): string {
		if ($operator !== null) $operator = trim($operator);
		$valid = $this->isValidOperator($operator);
		if (!$valid) return '=';
		if ($operator === '!=') $operator = '<>';
		if ($operator === '==') $operator = '=';
		return $operator;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::getValidOutput()
	 * 
	 * @param string $output - Output data type
	 * @param bool &$valid - Provided output was valid (passed by reference)
	 * @return string - Valid output data type
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function getValidOutput(?string $output, bool &$valid = false): string {
		if ($output !== null) $output = trim($output);
		$valid = $this->isValidOutput($output);
		if (!$valid) return ($this->isValidOutput($this->config['output'])? $this->config['output'] : ($this->isValidOutput($this->output)? $this->output : 'auto'));
		if ($output === 'int') $output = 'integer';
		if ($output === 'obj') $output = 'object';
		if ($output === 'str') $output = 'string';
		return $output;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::normalizeWhere()
	 * 
	 * @param array $array - Array to normalize
	 * @return array $normalized - Normalized array
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function normalizeWhere(array $array = []): array {
		if (empty($array)) $this->error('No array to normalize!');
		$normalized = [];
		foreach ($array as $key => $arg) {
			if (!is_numeric($key) && !is_array($arg)) {
				$normalized[] = [
					'column' => $key,
					'value' => $arg ?? null,
					'op' => '='
				];
			} else if (is_array($arg)) {
				if (isset($arg[0]) && is_array($arg[0])) {
					$normalized[] = $this->normalizeWhere($arg);
				} else if (isset($arg['column'])) {
					$normalized[] = [
						'column' => $arg['column'],
						'value' => $arg['value'] ?? null,
						'op' => $this->getValidOperator($arg['op'])
					];
				} else {
					$normalized[] = [
						'column' => $arg[0],
						'value' => $arg[1] ?? null,
						'op' => $this->getValidOperator($arg[2])
					];
				}
			}
		}
		return $normalized;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::resetState()
	 * 
	 * @return bool - True
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function resetState(): bool {
		// TODO: Remove this line of code after checking that bindings work.
		//if ($this->command === 'query') echo '<pre>' . print_r($this->queryParts, true) . '</pre>';
		$this->command = null;
		$this->keyword = null;
		$this->queryParts = [
			'bindings' => [],
			'filter' => [],
			'insert' => [],
			'join' => [], /* unused */
			'limit' => [],
			'order' => [],
			'query' => '',
			'replace' => [],
			'select' => [],
			'show' => '',
			'update' => [],
			'where' => []
		];
		$this->orwhere = false;
		$this->output = $this->config['output'];
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::searchStr()
	 * 
	 * @param string $str - Search string
	 * @param bool $startsWith - Start flag
	 * @param bool $endsWith - End flag
	 * @return string - The search term
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function searchStr(string $str, string $op = '%'): string {
		$str = match($op) {
			'=%'	=> "$str%",
			'%='	=> "%$str",
			default	=> "%$str%"
		};
		return $str;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::whereGroup()
	 * 
	 * @param array $array - Nested array
	 * @return $this
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function whereGroup(array $array): static {
		$connector = ($this->orwhere === true? ' AND ' : ' OR ');
		$group = [];
		foreach ($array as $arg) {
			$group[] = $this->whereStr($arg['column'], $arg['value'], $arg['op']);
		}
		if (!empty($group)) $this->queryParts['where'][] = '(' . implode($connector, $group) . ')';
		return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::whereStr()
	 * 
	 * @param string $column - Column name
	 * @param mixed $value - Column value
	 * @param string $op - Comparison operator (=, !=, <>, >, <, >=, <=, <=>, %, %=, =%)
	 * @return $sql - Where clause
	 * @access protected
	 * ----------------------------------------------------------------------*/
	// TODO: Add between.
	protected function whereStr(string $column, mixed $value = null, string $op = '='): string {
		$op = $this->getValidOperator($op);
		if ($value === null) {
			$sql = match($op) {
				'=', '=='	=> $this->sqlWrap($column) . ' IS NULL',
				'!=', '<>'	=> $this->sqlWrap($column) . ' IS NOT NULL',
				'<=>'		=> $this->sqlWrap($column) . ' <=> NULL',
				default		=> $this->sqlWrap($column) . ' IS NULL'
			};
		} else if (is_bool($value)) {
			$boolStr = ($value === true? 'TRUE' : 'FALSE');
			$sql = match($op) {
				'=', '=='	=> $this->sqlWrap($column) . ' IS ' . $boolStr,
				'!=', '<>'	=> $this->sqlWrap($column) . ' IS NOT ' . $boolStr,
				'<=>'		=> $this->sqlWrap($column) . ' <=> ' . $boolStr,
				default		=> $this->sqlWrap($column) . ' IS ' . $boolStr
			};
		} else {
			switch ($op) {
				case '%': case '%=': case '=%':
					$sql = $this->sqlWrap($column) . ' LIKE ?';
					$this->queryParts['bindings']['where'][] = $this->searchStr($value, $op);
				break;
				default:
					$sql = $this->sqlWrap($column) . ' ' . $op . ' ?';
					$this->queryParts['bindings']['where'][] = $value;
				break;
			}
		}
		return $sql;
	}
	
	/* ----------------------------------------------------------------------
	 * Destruct
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyDB::__destruct()
	 * 
	 * @return void
	 * ----------------------------------------------------------------------*/
	public function __destruct() {
		$this->db->close();
	}
    
}

?>
