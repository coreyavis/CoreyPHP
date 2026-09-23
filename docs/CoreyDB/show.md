# show

Acts as a dynamic SQL builder for metadata queries. It maps input arguments to valid `SHOW` syntax, handling the boilerplate logic for inspecting database structures, schemas, and table statuses.

> :pushpin: **Execution Required**: This method only constructs the SQL statement. You must terminate the method chain with `->execute()` to actually run the query against the database or `->preview()` to view the sql code.

## Usage

```
show(string $keyword = 'tables'): static
```

## Parameters

**keyword** (string)
: The keyword for the specific `SHOW` statement to execute. (*default*: `'tables'`)

### Keywords

| Category | Keyword | What it Returns | Description |
| --- | --- | --- | --- |
| Server | engine | `SHOW ENGINE [name] STATUS` | Retuns the raw, multi-line health and transaction logs of a specific storage engine (e.g., InnoDB). |
| Server | engines | `SHOW ENGINES` | Lists all supported storage engines (e.g., InnoDB, Memory) and which is default." |
| Server | plugins | `SHOW PLUGINS` | Displays server plugin status (e.g., authentication modules, event schedulers)." |
| Server | privileges | `SHOW PRIVILEGES` | Lists the system privileges supported by the MySQL server. |
| Server | processlist | `SHOW PROCESSLIST` | Diagnostic/Admin: Shows which threads/queries are currently running on the server. |
| Server | status | `SHOW STATUS` | Diagnostic: Provides server performance counters and operational status metrics. |
| Server | variables | `SHOW VARIABLES` | Returns global and session system configurations (hundreds of settings). |
| Database | charset | `SHOW CHARACTER SET` | Lists all available character sets supported by the database engine. |
| Database | collation | `SHOW COLLATION` | Lists all sorting and comparison rules (collations) available for charsets. |
| Database | databases | `SHOW DATABASES` | Lists all schemas/databases available on the connected server instance. |
| Database | open tables | `SHOW OPEN TABLES` | Lists tables currently open in the server's table cache (useful for optimization). |
| Database | tables | `SHOW TABLES` | Lists all physical tables inside the currently selected database. |
| Table | table status | `SHOW TABLE STATUS` | Provides high-level metadata (Engine, Row count, Collation) for tables." |
| Table | columns | `SHOW COLUMNS` | Lists all fields, data types, and null/key attributes for the active table." |
| Table | index | `SHOW INDEX` | Returns detailed index performance and structure data for the active table. |
| Table | keys | `SHOW KEYS` | Alias for index data; lists primary, foreign, and unique key constraints." |

> :pushpin: Options categorized under Server and Database can be run immediately upon establishing a connection.
>
> Options categorized under Table dynamically target the table currently stored in the class state (`$this->table`). Ensure you call `setTable()` before executing these commands to prevent query erros.

## Return Value

(static)
: Returns the current instance to allow for method chaining.

> NOTE: This method does not execute the query immediately. You must chain the `execute()` method at the end of your chain to run the query against the database.
>
> Upon successful execution, the `execute()` method returns the metadata associated with the `SHOW` statement.

## Method Chaining

Before calling `execute()`, you can chain the following modifiers to customize your results:

- `filter(...)` [[?]](filter.md): Filters the returned dataset based on specified conditions.
- `output(...)` [[?]](output.md): Defines the structure of the output data (e.g., Array, JSON, Object, Serial).

## Examples

```
$db->show('tables')->execute();
// Result: SHOW TABLES

$engines = $db->show('engines')->output('json')->execute();
```

## Debug Errors

- No debug errors.

## Related Methods

[delete](delete.md) | [insert](insert.md) | [replace](replace.md) | [select](select.md) | [update](update.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
